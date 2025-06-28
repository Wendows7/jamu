<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Services\OrderService;
use App\Services\ProductService;
use App\Services\PaymentService;
use App\Services\StockProductService;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $productService;
    protected $cartService;

    protected $transactionService;

    protected $orderService;
    protected $paymentService;

    protected $stockProductService;

    public function __construct(ProductService $productService, CartService $cartService,
                                transactionService $transactionService, OrderService $orderService,
                                PaymentService $paymentService, StockProductService $stockProductService)
    {
        $this->productService = $productService;
        $this->cartService = $cartService;
        $this->transactionService = $transactionService;
        $this->orderService = $orderService;
        $this->paymentService = $paymentService;
        $this->stockProductService = $stockProductService;
    }

    public function index()
    {
        $totalProductByCategory = $this->productService->getTotalProductByCategory();
        $products = $this->productService->getAllProducts();

        if (session('cart')) {
            $cartData = session('cart');
            $totalCart = 0;
            if (isset($cartData)) {
                foreach ($cartData as $key => $item) {
                    $totalCart += $item['price'] * $item['quantity']; // Saat ini quantity statis '1'
                    $cartData[$key]['total'] = $item['price'] * $item['quantity'];
                }
            }
            return view('cart.index', compact('totalProductByCategory', 'products', 'cartData', 'totalCart'));
        } else {
            $totalCart = 0;
            return view('cart.index', compact('totalProductByCategory', 'products', 'totalCart'));
        }


    }

//    method to add product to cart
    public function addToCart(Request $request)
    {
        $this->cartService->addToCart($request);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function removeFromCart(Request $request)
    {
        $this->cartService->removeFromCart($request->id);
        return response()->json(['success' => true]);
    }


    public function updateQuantity(Request $request)
    {
        $response = $this->cartService->updateQuantity($request);

        if ($response) {
            return response()->json(['success' => $response['success'], 'message' => $response['message'], 'price' => $response['price']]);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to update quantity!'], 400);
        }

    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Nothing Product To Checkout!');
        }


        $orderCode = $this->transactionService->checkout($request, $cart);

        session()->forget('cart');

        return redirect()->route('cart.orderDetail', ['orderCode' => $orderCode])->with('success', 'Checkout successful!');
    }

    public function createOrderDetail(Request $request)
    {
        $this->orderService->createOrderDetail($request);
        $paymentMethod = $this->paymentService->getPaymentById($request->payment_method);
        $orderCode = $request->orderCode;
        $totalPrice = $this->orderService->getByOrderCode($orderCode)->total_price;

        return redirect()->route('payment')->with([
            'payment_method' => $paymentMethod,
            'orderCode' => $orderCode,
            'totalPrice' => $totalPrice
        ]);
    }

    public function payment()
    {
        $paymentMethod = session('payment_method');
        $orderCode = session('orderCode');
        $totalPrice = session('totalPrice');
        $totalProductByCategory = $this->productService->getTotalProductByCategory();


        return view('components.payment', compact('paymentMethod', 'orderCode', 'totalPrice', 'totalProductByCategory'));
    }

    public function buyNow(Request $request)
    {
        $orderCode = $this->transactionService->checkout($request, null);

        return redirect()->back()->with('open_modal', true)->with('orderCode', $orderCode);
    }

    public function OrderDetail()
    {
        $totalProductByCategory = $this->productService->getTotalProductByCategory();
        $orderCode = request()->route('orderCode');
        if (!$orderCode) {
            return redirect()->route('products')->with('error', 'No order code found!');
        }
        $orderData = $this->orderService->getByOrderCode($orderCode);
        if (!$orderData) {
            return redirect()->route('products')->with('error', 'Order not found!');
        }
        $transactionsData = $this->transactionService->getByOrderId($orderData->id);
        $paymentData = $this->paymentService->getPayment();

        return view('cart.order-detail', compact('orderData', 'transactionsData', 'paymentData', 'totalProductByCategory'));
    }

    public function addPaymentProof(Request $request)
    {
        $this->orderService->updateOrderProof($request);
        return redirect()->route('user.orders')
            ->with('success', 'Berhasil mengunggah bukti pembayaran, silakan tunggu konfirmasi dari admin.');
    }

}
