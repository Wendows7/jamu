<?php

namespace App\Http\Controllers;

use App\Services\CategoryProductService;
use App\Services\PartnershipService;
use App\Services\ProductService;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $product;
    protected $transactionService;

    protected $partnershipService;
    protected $productCategoryService;

    public function __construct(ProductService $productService, transactionService $transactionService, PartnershipService $partnershipService, CategoryProductService $productCategoryService)
    {
        $this->product = $productService;
        $this->transactionService = $transactionService;
        $this->partnershipService = $partnershipService;
        $this->productCategoryService = $productCategoryService;
    }

    public function index()
    {
        $totalProductByCategory = $this->product->getTotalProductByCategory();
        $products = $this->product->getAllProducts()->paginate(10);
        $mostSoldProducts = $this->transactionService->getMostSoldProduct();
        $categories = $this->productCategoryService->getAll()->take(5);

        return view('contacts.index', compact('totalProductByCategory', 'products', 'mostSoldProducts', 'categories'));
    }
}
