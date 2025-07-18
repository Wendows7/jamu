<?php

namespace App\Http\Controllers;

use App\Services\AdminService;
use App\Services\CategoryProductService;
use App\Services\OrderService;
use App\Services\PartnershipService;
use App\Services\ProductService;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Services\PartnerSendHistoryService;
use App\Services\StockProductService;

class AdminController extends Controller
{
    protected $productService;
    protected $userService;
    protected $adminService;
    protected $categoryService;

    protected $orderService;

    protected $parnershipService;
    protected $partnerSendHistoryService;
    protected $stockProductService;

    public function __construct(ProductService $productService, UserService $userService, AdminService $adminService,
                                CategoryProductService $categoryService, OrderService $orderService, PartnershipService $partnershipService,
                                PartnerSendHistoryService $partnerSendHistoryService, StockProductService $stockProductService)
    {
        $this->productService = $productService;
        $this->userService = $userService;
        $this->adminService = $adminService;
        $this->categoryService = $categoryService;
        $this->orderService = $orderService;
        $this->parnershipService = $partnershipService;
        $this->partnerSendHistoryService = $partnerSendHistoryService;
        $this->stockProductService = $stockProductService;
    }

    public function index()
    {
        return view('dashboard.index',[
            'selisihMenit' => $this->adminService->showMinute()

        ]);
    }

    public function users()
    {
        $users = $this->adminService->getAllUser();
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        $selisihMenit = $this->adminService->showMinute();

        return view('dashboard.user.index', compact('users', 'selisihMenit'));



    }

    public function deleteUserById($id)
    {
        $this->userService->deleteUserById($id);

        return redirect()->back()->with('success', 'User has been deleted!');
    }

    public function addUser(Request $request)
    {
        $checkDuplicateUser = $this->userService->checkDuplicateUser($request->email);

        if ($checkDuplicateUser) {
            return redirect()->back()->with('error', 'Email already exists!');
        }
        $validateData = $request->validate([
            'name' => 'required|min:5|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5',
        ]);

        $validateData['password'] = bcrypt($validateData['password']);
        $validateData['role'] = 'user';

        $this->userService->addUser($validateData);

        return redirect()->back()->with('success', 'User has been created!');

    }

    public function editUserById(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|min:5|max:255',
                'email' => 'required|email:dns',
                'role' => 'required',
            ]);

        if($request->password == ''){
            $validatedData['password'] = $this->userService->getUserById($request->id)->password;
        }else{
            $validatedData['password'] = bcrypt($request->password);
        }

        $this->userService->editById($request->id, $validatedData);

        return redirect()->back()->with('success', 'Success Update Data');

    }

    public function getProducts()
    {
        $products = $this->productService->getProducts();
        $categories = $this->categoryService->getAll();
        $title = 'Delete Product!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        $selisihMenit = $this->adminService->showMinute();

        return view('dashboard.products.index', compact('products', 'selisihMenit', 'categories'));
    }

    public function deleteProductById(Request $request)
    {
        $this->productService->deleteById($request->id);

        return redirect()->back()->with('success', 'Product has been deleted!');
    }

    public function showDetailProduc(Request $request)
    {
        $data = $this->productService->findById($request->id);
    }

    public function editProduct(Request $request)
    {
//        dd($request->all());
        $update = $this->productService->editProduct($request);

        if ($update) {
            return redirect()->back()->with('success', 'Success Update Data');
        }

        return redirect()->back()->with('error', 'Failed Update Data');

    }

    public function addProduct(Request $request)
    {

        $this->productService->createProduct($request);

        return redirect()->back()->with('success', 'Success Create Data');

    }

    public function getCategory()
    {
        $categories = $this->categoryService->getAll();
        $title = 'Delete Category!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        $selisihMenit = $this->adminService->showMinute();

        return view('dashboard.category.index', compact('categories', 'selisihMenit'));
    }

    public function addCategory(Request $request)
    {
        $this->categoryService->addCategory($request);

        return redirect()->back()->with('success', 'Success Create Data');

    }

    public function editCategoryById(Request $request)
    {
        $this->categoryService->editCategory($request);

        return redirect()->back()->with('success', 'Success Edit Data');
    }

    public function deleteCategoryById(Request $request)
    {

        $this->categoryService->deleteCategoryById($request->id);

        return redirect()->back()->with('success', 'Category has been deleted!');
    }

    public function getOrders()
    {
        $orders = $this->orderService->getOrderData();
        $title = 'Delete Category!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        $selisihMenit = $this->adminService->showMinute();

        return view('dashboard.orders.index', compact('orders', 'selisihMenit'));
    }

    public function updateStatusOrder(Request $request)
    {

        $this->orderService->updateStatusOrderByOrderCode($request);

        return redirect()->back()->with('success', 'Order status has been updated!');

    }

    public function getPartnerships()
    {
        $partnerships = $this->parnershipService->getAllData();
        $title = 'Delete Partnership!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        $selisihMenit = $this->adminService->showMinute();

        return view('dashboard.partnerships.index', compact('partnerships', 'selisihMenit'));

    }

    public function updatePartnershipStatus(Request $request)
    {
        $this->parnershipService->updateStatus($request);

        return redirect()->back()->with('success', 'Partnership status has been updated!');
    }

    public function getPartnerSendHistory()
    {
        $data = $this->partnerSendHistoryService->getAll();
        $product = $this->productService->getProducts();
        $partner = $this->parnershipService->getAllData();
        $title = 'Delete Partnership!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        $selisihMenit = $this->adminService->showMinute();

        return view('dashboard.partnerships.send-history', compact('data', 'selisihMenit', 'product', 'partner'));
    }

    public function addPartnerSendHistory(Request $request)
    {
        $this->partnerSendHistoryService->create($request);
        $this->stockProductService->decreaseStock($request->product_id, $request->size, $request->quantity);

        return redirect()->back()->with('success', 'Data has been created!');
    }
}
