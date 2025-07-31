<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AuthService;
use App\Services\ProductService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Services\CategoryProductService;

class LoginController extends Controller
{
    protected $productService;
    protected $authService;

    protected  $categoryProductService;

    public function __construct(ProductService $productService, AuthService $authService, CategoryProductService $categoryProductService)
    {
        $this->productService = $productService;
        $this->authService = $authService;
        $this->categoryProductService = $categoryProductService;
    }

    public function index()
    {
//        check if user is already logged in
        if (Auth::check()) {
            return redirect()->route('home')->with('success', 'You are already logged in!');
        }
        $totalProductByCategory = $this->productService->getTotalProductByCategory();
        $products = $this->productService->getAllProducts()->paginate(10);
        $categories = $this->categoryProductService->getAll()->take(5);

        return view('auth.login', compact('totalProductByCategory', 'products', 'categories'));
    }


    public function authenticate(Request $request) : RedirectResponse
    {
        $auth = $this->authService->authenticate($request);
        if ($auth) {
            if (auth()->user()->role == 'admin')
            {
                $waktuLogin = Carbon::now();
                $waktuLogin = session()->put('waktuLogin', $waktuLogin);
                return redirect()->route('admin.orders');
            }
            return redirect()->route('home')->with('success', 'Login Successful!');
        }else{
            return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'logged out successfully.');
    }

    public function register()
    {
        $totalProductByCategory = $this->productService->getTotalProductByCategory();
        $products = $this->productService->getAllProducts()->paginate(10);
        $categories = $this->categoryProductService->getAll()->take(5);

        return view('auth.register', compact('totalProductByCategory', 'products', 'categories'));
    }

    public function store(Request $request) : RedirectResponse
    {

        try {
            $validateData = $request->validate([
                'name' => 'required|min:5|max:255',
                'email' => 'required|email:dns|unique:users',
                'password' => 'required|min:5',
                'role' => 'required|in:user,partner',
            ]);

            $validateData['password'] = bcrypt($validateData['password']);

            User::create($validateData);

            return redirect()->route('auth.login')->with('success', 'Registration successful! Please login.');

        } catch (\Exception $e) {
            // Log error jika perlu
            Log::error('Registration Error: ' . $e->getMessage());

            // Redirect kembali dengan pesan error
            return redirect()->back()->withInput()->with('error', 'Registration failed. Please try again.');
        }


    }
}
