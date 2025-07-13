<?php

namespace App\Http\Controllers;

use App\Services\PartnershipService;
use App\Services\ProductService;
use App\Services\TransactionService;
use App\Services\CategoryProductService;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    protected $product;
    protected $transactionService;
    protected $productCategoryService;


    public function __construct(ProductService $productService, transactionService $transactionService, CategoryProductService $categoryProductService)
    {
        $this->product = $productService;
        $this->transactionService = $transactionService;
        $this->productCategoryService = $categoryProductService;
    }

    public function index()
    {
        $totalProductByCategory = $this->product->getTotalProductByCategory();
        $products = $this->product->getAllProducts()->paginate(10);
        $mostSoldProducts = $this->transactionService->getMostSoldProduct();
        $categories = $this->productCategoryService->getAll()->take(5);

        return view('about.index', compact('totalProductByCategory', 'products', 'mostSoldProducts', 'categories'));
    }
}
