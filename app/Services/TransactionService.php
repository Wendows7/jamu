<?php

namespace App\Services;

use App\Models\Transaction;

class TransactionService
{
    protected $transaction;
    protected $orderService;

    public function __construct(Transaction $transaction, OrderService $orderService)
    {
        $this->transaction = $transaction;
        $this->orderService = $orderService;
    }

    public function getAllTransactions(){
        return $this->transaction->with('product', 'user')->get();
    }

    public function checkout($request, $cartData)
    {
        if ($cartData == null)
        {
//        make order id
            $totalPrice = $request->price * $request->quantity;
            $createId = $this->orderService->createOrder($request->user_id, $totalPrice);
            $orderId = $this->orderService->getByOrderCode($createId)->id;

                $validateData[$request->product_id] = [
                    'product_id' => $request->product_id, // Assuming 'id' is the product ID
                    'quantity' => $request->quantity,
                    'total_price' => $totalPrice,
                    'user_id' => $request->user_id,
                    'order_id' => $orderId,
                    'size' => $request->size,
                ];
                $this->transaction->create($validateData[$request->product_id]);

            return $createId;
        }else{
            $totalPrice = 0;
            foreach ($cartData as $key => $item) {
                $cartData[$key]['total_price'] = $item['price'] * $item['quantity'];
            }
    //        make total price
            $totalPrice = array_sum(array_column($cartData, 'total_price'));

    //        make order id
            $createId = $this->orderService->createOrder($request->user_id, $totalPrice);
            $orderId = $this->orderService->getByOrderCode($createId)->id;


            foreach ($cartData as $key => $item) {
                $validateData[$key] = [
                    'product_id' => $key, // Assuming 'id' is the product ID
                    'quantity' => $item['quantity'],
                    'total_price' => $item['total_price'],
                    'user_id' => $request->user_id,
                    'order_id' => $orderId,
                    'size' => $item['size'],
                ];
            $this->transaction->create($validateData[$key]);
            }

            return $createId;

        }

    }

    public function getByTxByUser($userId)
    {
        $orders = $this->orderService->getOrderCodeByUserId($userId);

        $finalData = [];
        foreach ($orders as $order) {
            $transactions = $this->transaction->where('order_id', $order->id)
                ->with('product') // Eager load relasi product
                ->get();

            $transactionDetails = $transactions->map(function ($transaction) {
                return [
                    'product_name' => $transaction->product->name,
                    'quantity' => $transaction->quantity,
                    'product_price' => $transaction->product->price,
                    'total_price' => $transaction->total_price,
                ];
            });

            $finalData[$order->order_code] = [
                'status' => $order->status,
                'data' => $transactionDetails,
                'total_price' => $transactions->sum('total_price'),
                'payment' => $order->payment,
            ];
        }

        dd($finalData);
        return $this->transaction->where('order_code', $orderCode)->with('product', 'payment')->get();
    }

    public function getByOrderId($orderId)
    {
        return $this->transaction->where('order_id', $orderId)
            ->with(['product.stockProduct', 'payment'])
            ->get();
    }

    public function getMostSoldProduct()
    {
        return $this->transaction->select('product_id', \DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id')
            ->orderBy('total_quantity', 'desc')
            ->with('product')
            ->take(2)
            ->get();
    }



}
