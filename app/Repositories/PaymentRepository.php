<?php

namespace  App\Repositories;

use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;
class PaymentRepository extends Repository
{
    public function __construct(Payment $payment)
    {
        $this->setModel($payment);
    }

}
