<?php

namespace App\Services;

use App\Repositories\PaymentRepository;

class PaymentService
{
    protected PaymentRepository $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->repository = $paymentRepository;
    }
    public function create($request)
    {   
        $data = $request->all();
        $data['status'] = date('Y-m-d') > date($request->due_on) ? "overdue" :"outstanding";
        $payment = $this->repository->create($data);
        
        return [$payment, "created", 200];

    }
}
