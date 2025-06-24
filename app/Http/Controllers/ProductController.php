<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use App\Services\StockProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;
    protected $stockProductService;

    public function __construct(ProductService $productService, StockProductService $stockProductService)
    {
        $this->product = $productService;
        $this->stockProductService = $stockProductService;
    }
    public function index()
    {
        $products = $this->product->getAllProducts()->paginate(8);
        $totalProduct = $this->product->getTotalProduct();
        $totalProductByCategory = $this->product->getTotalProductByCategory();
        return view('products.index', compact('products', 'totalProduct', 'totalProductByCategory'));

    }

    public function shortBy($shortBy)
    {
        $products = $this->product->shortBy($shortBy);
        $totalProduct = $this->product->getTotalProduct();
        $totalProductByCategory = $this->product->getTotalProductByCategory();
        return view('products.main', compact('products', 'totalProductByCategory', 'totalProduct'));
    }

    public function detail($productId)
    {
        $product = $this->product->findById($productId);
        $totalStock = $this->stockProductService->totalStockByProductId($productId);

        $products = Product::with('stockProduct')->get();
        $totalProductByCategory = $this->product->getTotalProductByCategory();
        return view('products.detail', compact('product', 'products','totalProductByCategory', 'totalStock'));
    }

    public function store(Request $request)
    {
        $this->product->storeProduct($request);

        return response()->json(["success" => true]);
    }

    public function search(Request $request)
    {
        $slug = $request->query('slug');
        $totalProduct = $this->product->getTotalProduct();
        $products = $this->product->searchProduct($slug);
        $totalProductByCategory = $this->product->getTotalProductByCategory();
        if ($products->isEmpty()) {
            return redirect()->back()->with('error', 'Product not found');
        }
        return view('products.index', compact('products','totalProduct','totalProductByCategory'));
    }
}
