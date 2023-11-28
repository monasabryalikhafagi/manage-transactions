<?php

namespace App\Services;

use App\Repositories\TransactionRepository;

class TransactionService
{
    protected TransactionRepository $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->repository = $transactionRepository;
    }
    public function create($request)
    {   
        $data = $request->all();
        $data['status'] = date('Y-m-d') > date($request->due_on) ? "overdue" :"outstanding";
        $transaction = $this->repository->create($data);
        
        return [$transaction, "created", 200];

    }
}
