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

    public function getAll()
    {
        $data = $this->partnerSendHistory->with(['partnership', 'product.stockProduct'])->get();
        $dataFinal= $data->map(function ($item) {
            return [
                'id' => $item->id,
                'product_name' => $item->product->name,
                'company_name' => $item->partnership->company_name,
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
            'partnership_id' => 'required|exists:partnerships,id',
            'quantity' => 'required|integer|min:1',
            'size' => 'required|string',
        ]);


        return $this->partnerSendHistory->create($validatedData);
    }
}
