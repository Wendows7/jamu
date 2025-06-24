<?php

namespace App\Services;


use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Transaction;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use function Symfony\Component\Translation\t;

class OrderService
{

    protected $orderService;

    protected $transactionService;

    protected $paymentService;

    protected $orderDetailService;

    protected $userService;

    public function __construct(Order $orderService, Transaction $transactionService,
                                Payment $paymentService, OrderDetail $orderDetailService, User $userService)
    {
        $this->transactionService = $transactionService;
        $this->orderService = $orderService;
        $this->paymentService = $paymentService;
        $this->orderDetailService = $orderDetailService;
        $this->userService = $userService;
    }

    public function createOrder($userId, $totalPrice)
    {
        $orderId = (string) \Str::uuid();
        $this->orderService->create([
            'order_code' => $orderId,
            'user_id' => $userId,
            'status' => 'pending',
            'total_price' => $totalPrice
        ]);
        return $orderId;
    }

    public function getByOrderCode($orderCode)
    {
        return $this->orderService->where('order_code', $orderCode)->with('transactions', 'user')->first();
    }

    public function getOrderDataByUserId($userId)
    {
        $orderData = $this->orderService->where('user_id', $userId)->with('transactions')->latest()->get();
        $data = collect($orderData)->map(function ($order) {
            return [
                'order_code' => $order->order_code,
                'status' => $order->status,
                'total_price' => $order->total_price,
                'created_at' => $order->created_at,
                'transactions' => $this->transactionService->where('order_id', $order->id)->with('product')->get(),
                'payment' => $this->paymentService->where('order_id', $order->id)->get(),
            ];
        });

        return $data;
    }

    public function createOrderDetail(Request $request)
    {

//        $userId = auth()->user()->id;
        $order = $this->orderService->where('order_code', $request->orderCode)->first();

        $orderDetail = $this->orderDetailService->where('order_id', $order->id)->first();

        if ($orderDetail == null)
        {
        $orderDetail = OrderDetail::create([
            'order_id' => $order->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
        ]);
        $this->orderService->where('order_code', $request->orderCode)->update(['payment_id' => $request->payment_method]);

        return true;
        } else
        {
            return false;

        }


    }

    public function getOrderDetailByOrderId($id)
    {
        return OrderDetail::where('order_id', $id)->first();
    }

    public function getOrderHistoryByUser($userId)
    {
        return $this->orderService->where('user_id', $userId)->with('transactions', 'orderDetails')->get();
    }

    public function cancelOrderByOrderCode($orderCode)
    {
        Order::where('order_code', $orderCode)->update(['status' => 'cancel']);
    }

    public function getOrderData()
    {
        $orderData = $this->orderService->latest()->with('transactions','user')->get();
        $data = collect($orderData)->map(function ($order) {
            return [
                'order_code' => $order->order_code,
                'status' => $order->status,
                'total_price' => $order->total_price,
                'created_at' => $order->created_at,
                'transactions' => $this->transactionService->where('order_id', $order->id)->with('product')->get(),
                'payment' => $this->paymentService->where('order_id', $order->id)->get(),
                'user' => $order->user,
            ];
        });

        return $data;
    }

    public function updateStatusOrderByOrderCode($request)
    {
        $this->orderService->where('order_code', $request->order_code)->update(['status' => $request->status]);
    }

    public function updateOrderProof($request)
    {
        $order = $this->orderService->where('order_code', $request->orderCode)->first();

        if ($order) {
            $order->update(['payment_proof' => $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public')]);
            return true;
        }

        return false;
    }


}
