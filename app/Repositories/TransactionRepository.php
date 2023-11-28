<?php

namespace  App\Repositories;

use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;
class TransactionRepository extends Repository
{
    public function __construct(Transaction $transaction)
    {
        $this->setModel($transaction);
    }

}
