<?php

namespace App\Services;

use App\Models\Payment;

class PaymentService
{

    protected $paymentService;
    public function __construct(Payment $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function createOrderPayment($orderId, $paymentName)
    {
        return $this->paymentService->create([
            'name' => $paymentName,
            'order_id' => $orderId,
        ]);
    }

    public function getPayment()
    {
        return $this->paymentService->all();
    }

    public function getPaymentById($id)
    {
        return $this->paymentService->where('id', $id)->first();
    }

}
