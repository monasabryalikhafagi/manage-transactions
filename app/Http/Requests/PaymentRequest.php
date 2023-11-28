<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
class PaymentRequest extends BaseRequest
{
   

      /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function createRules() :array
    {
        return [
            'amount' => "required|min:1",
            'paid_on' =>"required|date",
            'details'=> "nullable|min:1|max:500000",
            'transaction_id' => "required|exists:transactions,id",
        ];
    }
}
