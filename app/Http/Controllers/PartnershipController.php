<?php

namespace App\Http\Controllers;

use App\Models\Partnership;
use App\Services\PartnershipService;
use App\Services\ProductService;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class PartnershipController extends Controller
{

    protected $product;
    protected $transactionService;

    protected $partnershipService;

    public function __construct(ProductService $productService, transactionService $transactionService, PartnershipService $partnershipService)
    {
        $this->product = $productService;
        $this->transactionService = $transactionService;
        $this->partnershipService = $partnershipService;
    }

    public function index()
    {
        $totalProductByCategory = $this->product->getTotalProductByCategory();
        $products = $this->product->getAllProducts()->paginate(10);
        $mostSoldProducts = $this->transactionService->getMostSoldProduct();
        return view('partnership.index', compact('totalProductByCategory', 'products', 'mostSoldProducts'));
    }

    public  function create(Request $request)
    {
        $this->partnershipService->storePartnership($request);
        return redirect()->back()->with('success', 'Partnership request submitted successfully.');
    }
}
