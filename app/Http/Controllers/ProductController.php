<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use App\Services\StockProductService;
use App\Services\CategoryProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;
    protected $stockProductService;

    protected  $categoryProductService;

    public function __construct(ProductService $productService, StockProductService $stockProductService, CategoryProductService $categoryProductService)
    {
        $this->product = $productService;
        $this->stockProductService = $stockProductService;
        $this->categoryProductService = $categoryProductService;
    }
    public function index()
    {
        $products = $this->product->getAllProducts()->paginate(10);
        $totalProduct = $this->product->getTotalProduct();
        $totalProductByCategory = $this->product->getTotalProductByCategory();
        $categories = $this->categoryProductService->getAll()->take(5);

        return view('products.index', compact('products', 'totalProduct', 'totalProductByCategory', 'categories'));

    }

    public function shortBy($shortBy)
    {
        $products = $this->product->shortBy($shortBy);
        $totalProduct = $this->product->getTotalProduct();
        $totalProductByCategory = $this->product->getTotalProductByCategory();
        $categories = $this->categoryProductService->getAll()->take(5);

        return view('products.main', compact('products', 'totalProductByCategory', 'totalProduct', 'categories'));
    }

    public function detail($productId)
    {
        $product = $this->product->findById($productId);
        $totalStock = $this->stockProductService->totalStockByProductId($productId);

        $products = Product::with('stockProduct')->get();
        $totalProductByCategory = $this->product->getTotalProductByCategory();
        $categories = $this->categoryProductService->getAll()->take(5);

        return view('products.detail', compact('product', 'products','totalProductByCategory', 'totalStock', 'categories'));
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
        $categories = $this->categoryProductService->getAll()->take(5);
        if ($products->isEmpty()) {
            return redirect()->back()->with('error', 'Product not found');
        }
        return view('products.index', compact('products','totalProduct','totalProductByCategory', 'categories'));
    }

    public function getStocks($id)
    {
        // Fetch and return stocks for the given product
        $stocks = $this->stockProductService->getStockByProductId($id);
        return response()->json($stocks);
    }
}
