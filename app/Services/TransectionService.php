<?php

namespace App\Services;

use App\Repositories\TransactionRepository;

class TransactionService
{
    protected TransactionRepository $TransactionRepository;

    public function __construct(TransactionRepository $TransactionRepository)
    {
        $this->TransactionRepository = $TransactionRepository;
    }
}
