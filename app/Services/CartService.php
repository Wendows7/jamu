<?php

namespace App\Services;

use Illuminate\Http\Request;

class CartService
{
    protected $productService;
    protected $stockProductService;

    public function __construct(ProductService $productService, StockProductService $stockProductService)
    {
        $this->productService = $productService;
        $this->stockProductService = $stockProductService;
    }

    public function addToCart($request)
    {

//        if ($request->size == null)
//        {
//            return redirect()->back()->with('error', 'Please select product size!');
//        }
        $product = $this->productService->findById($request->product_id);
        if (!$product) {
            return redirect()->route('cart.index')->with('error', 'Product not found!');
        }
        $cart = session()->get('cart', []);
        if (isset($cart[$request->product_id])) {
            return redirect()->route('products')->with('error', 'Product already added to cart!');
        } else {
            $cart[$request->product_id] = [
                "name" => $product->name,
                "quantity" => $request->quantity,
                "price" => $product->stockProduct->where('product_id', $request->product_id)->where('size', $request->size)->first()->price,
                "image" => $product->image,
                'size' => $request->size,
                'data_stock' => $this->stockProductService->getStockByProductId($product->id),
            ];
        }
        session()->put('cart', $cart);

    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
    }

    public function updateQuantity(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'quantity' => 'required|integer|min:1',
//            'size' => 'required'
        ]);

        $cart = session()->get('cart');
        $price = $cart[$request->id]['data_stock']->where('size', $request->size)->first()->price;


        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = $request->quantity;
            $cart[$request->id]['size'] = $request->size;
            $cart[$request->id]['price'] = $price;
            session()->put('cart', $cart);
            return [
                'success' => true,
                'message' => 'Cart updated successfully!',
                'price' => $price
            ];
        } else {
            return false;
        }

    }
}
