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

    public function __construct(Partnership $partnership, User $userService, Product $product, PartnerSendHistory $partnerSendHistory)
    {
        $this->partnership = $partnership;
        $this->userService = $userService;
        $this->product = $product;
        $this->partnerSendHistory = $partnerSendHistory;
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
        return $dataFinal;
    }

    public function create($request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'partnership_id' => 'required',
            'quantity' => 'required',
            'size' => 'required',
            'batch_number' => 'required',
        ]);

//        map data
        $validatedData['status'] = 'pending'; // Default status
        $finalData = [];
            foreach ($validatedData['product_id'] as $key => $productId) {
                    $finalData[$key] = [
                        'product_id' => $productId,
                        'partnership_id' => $validatedData['partnership_id'],
                        'quantity' => $validatedData['quantity'][$key],
                        'size' => $validatedData['size'][$key],
                        'batch_number' => $validatedData['batch_number'][$key],
                        'status' => $validatedData['status'],
                    ];
//            insert data
            $this->partnerSendHistory->create($finalData[$key]);
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
            ->where('batch_number', $validatedData['batch_number'])
            ->first();
        $partnerSendHistory->update($validatedData);

        return $partnerSendHistory;
    }
}
