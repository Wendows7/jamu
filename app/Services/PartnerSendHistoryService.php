<?php

namespace App\Services;

use App\Models\Partnership;
use App\Models\User;
use App\Models\Product;
use App\Models\PartnerSendHistory;

class PartnerSendHistoryService
{
    protected $partnership;
    protected $userService;
    protected $product;
    protected $partnerSendHistory;
    protected $stockProductService;

    public function __construct(Partnership $partnership, User $userService, Product $product,
                                PartnerSendHistory $partnerSendHistory, StockProductService $stockProductService)
    {
        $this->partnership = $partnership;
        $this->userService = $userService;
        $this->product = $product;
        $this->partnerSendHistory = $partnerSendHistory;
        $this->stockProductService = $stockProductService;
    }

    public function getAll($type = null)
    {
        $data = $type === 1 ?
            $this->partnerSendHistory->with(['partnership', 'product.stockProduct'])->where('status', 'pending')->get() :
            $this->partnerSendHistory->with(['partnership', 'product.stockProduct'])->where('status', '!=', 'pending')->get();

//        $this->partnerSendHistory->with(['partnership', 'product.stockProduct'])->get();
        $dataFinal= $data->map(function ($item) {
            return [
                'id' => $item->id,
                'batch_number' => $item->batch_number,
                'product_name' => $item->product->name,
                'company_name' => $item->partnership->company_name,
                'partnership_id' => $item->partnership_id,
                'quantity' => $item->quantity,
                'size' => $item->size,
                'created_at' => $item->created_at->format('Y-m-d H:i:s'),
            ];
        });

        $grouped = $dataFinal
            ->groupBy(function ($item) {
                return $item['batch_number'] . '-' . $item['partnership_id'];
            })
            ->map(function ($items) {
                $first = $items->first();

                return [
                    'batch_number'    => $first['batch_number'],
                    'partnership_id'  => $first['partnership_id'],
                    'company_name'    => $first['company_name'],
                    'created_at'      => $first['created_at'],
                    'products'        => $items->map(function ($item) {
                        return [
                            'id'           => $item['id'],
                            'product_name' => $item['product_name'],
                            'quantity'     => $item['quantity'],
                            'size'         => $item['size'],
                        ];
                    })->values(),
                ];
            })->values();

//        merge array if batch and partnership id is same

        return $grouped;
    }

    public function create($request)
    {
        $validatedData = $request->validate([
            'products' => 'required',
            'partnership_id' => 'required',
            'batch_number' => 'required',
        ]);
//dd($request->all());
//        map data
        $validatedData['status'] = 'pending'; // Default status
        $finalData = [];
        foreach ($validatedData['batch_number'] as $key1 => $batch) {

            foreach ($validatedData['products'][$key1] as $key2 => $product) {
                foreach ($product as $key3 => $value) {
                $finalData[$key1][$key3] = [
                    'batch_number' => $batch,
                    'partnership_id' => $validatedData['partnership_id'],
                    'status' => $validatedData['status'],
                    'product_id' => $validatedData['products'][$key1]['product_id'][$key3],
                    'quantity' => $validatedData['products'][$key1]['quantity'][$key3],
                    'size' => $validatedData['products'][$key1]['size'][$key3],
                ];
                }

            }
            }
        //insert data
        foreach ($finalData as $key => $data) {
            foreach ($data as $key2 => $value) {
            $this->partnerSendHistory->create($value);
            }
        }


        return $finalData;
    }

    public function getById($id)
    {
        return $this->partnerSendHistory->with(['partnership', 'product.stockProduct'])
            ->where('partnership_id', $id)->where('status',  'pending')->get();
    }

    public function updateData($request)
    {
        $validatedData = $request->validate([
            'partnership_id' => 'required',
            'batch_number' => 'required',
            'status' => 'required',
        ]);

        $partnerSendHistory = $this->partnerSendHistory->where('partnership_id', $validatedData['partnership_id'])
            ->where('batch_number', $validatedData['batch_number'])->where('status', 'pending')
            ->get();

        foreach ($partnerSendHistory as $data) {
            $data->update($validatedData);
        // Update stock based on the size and quantity
            $this->stockProductService->decreaseStock($data->product_id, $data->size, $data->quantity);
        }

        return $partnerSendHistory;
    }

    public function getDataByUserId($userId)
    {
        $user = $this->userService->find($userId);
        if (!$user) {
            return null; // User not found
        }

        $partnerships = $this->partnership->where('user_id', $userId)->get();
        if ($partnerships->isEmpty()) {
            return []; // No partnerships found for the user
        }

        $data = [];
        foreach ($partnerships as $partnership) {
            $sendHistories = $this->partnerSendHistory->with('partnership')->where('partnership_id', $partnership->id)->get();
            $grouped = $sendHistories
                ->groupBy(function ($item) {
                    return $item['batch_number'] . '-' . $item['partnership_id'];
                })
                ->map(function ($items) {
                    $first = $items->first();
                    return [
                        'batch_number'    => $first['batch_number'],
                        'company_name'    => $first->partnership->company_name,
                        'created_at'      => $first['created_at'],
                        'products'        => $items->map(function ($item) {
                            return [
                                'id'           => $item['id'],
                                'product_name' => $item->product->name,
                                'quantity'     => $item['quantity'],
                                'size'         => $item['size'],
                            ];
                        })->values(),
                    ];
                })->values();
        }


        return collect($grouped);
    }
}
