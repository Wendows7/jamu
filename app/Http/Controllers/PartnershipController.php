<?php

namespace App\Http\Controllers;

use App\Models\Partnership;
use App\Services\PartnershipService;
use App\Services\ProductService;
use App\Services\TransactionService;
use App\Services\CategoryProductService;
use Illuminate\Http\Request;

class PartnershipController extends Controller
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

        return view('partnership.index', compact('totalProductByCategory', 'products', 'mostSoldProducts', 'categories'));
    }

    public  function create(Request $request)
    {
        $this->partnershipService->storePartnership($request);
        return redirect()->back()->with('success', 'Partnership request submitted successfully.');
    }

    public function partnershipData()
    {
        $totalProductByCategory = $this->product->getTotalProductByCategory();
        $products = $this->product->getAllProducts()->paginate(10);
        $mostSoldProducts = $this->transactionService->getMostSoldProduct();
        $categories = $this->productCategoryService->getAll()->take(5);

        $data = $this->partnershipService->getDataByUserId(auth()->user()->id);

        return view('partnership.partnership-data', compact('totalProductByCategory', 'products', 'mostSoldProducts', 'categories', 'data'));

    }

    public function uploadReplyFile(Request $request)
    {
        $data = $this->partnershipService->uploadReplyFile($request);

        if ($data) {
            return redirect()->back()->with('success', 'Partnership request submitted successfully.');
        }

        return redirect()->back()->withErrors(['file' => 'Failed to upload file. Please try again.']);

    }

}
