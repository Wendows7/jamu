<?php

namespace App\Services;

use App\Models\Product;
use App\Models\StockProduct;

class StockProductService
{
    protected $product;

    protected $stockProduct;

    public function __construct(Product $product, StockProduct $stockProduct)
    {
        $this->product = $product;
        $this->stockProduct = $stockProduct;
    }

    public function totalStockByProductId($productId)
    {
//    $total = $this->stockProduct->where('product_id', $productId)->get()->sum((function ($stock) {
//            return $stock->size_39 + $stock->size_40 + $stock->size_41 + $stock->size_42 + $stock->size_43;
//        }));

        $total = $this->stockProduct->where('product_id', $productId)->sum('stock');
        return $total;
    }

    public function getStockSizeByProductId($productId,$size)
    {
        return $this->stockProduct->where('product_id',$productId)->where('size', $size)->get()->first()->stock;
    }

    public function updateStockById($id, $size, $stock)
    {
//        dd($id,$size,$stock);
        $this->stockProduct->where('product_id', $id)->where('size', $size)->update(['stock' => $stock]);
    }

    public function getStockByProductId($productId)
    {
        return $this->stockProduct->where('product_id', $productId)->get();
    }

    public function decreaseStock($productId, $size, $quantity)
    {
        $stock = $this->getStockSizeByProductId($productId, $size);
        if ($stock >= $quantity) {
            $newStock = $stock - $quantity;
            $this->updateStockById($productId, $size, $newStock);
            return true;
        }
        return false; // Not enough stock available
    }
}
