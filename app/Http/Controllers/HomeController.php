<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $product;
    protected $transactionService;

    public function __construct(ProductService $productService, transactionService $transactionService)
    {
        $this->product = $productService;
        $this->transactionService = $transactionService;
    }

    public function index()
    {
        $totalProductByCategory = $this->product->getTotalProductByCategory();
        $products = $this->product->getAllProducts()->paginate(10);
        $mostSoldProducts = $this->transactionService->getMostSoldProduct();
        return view('home', compact('totalProductByCategory', 'products', 'mostSoldProducts'));
    }
}
