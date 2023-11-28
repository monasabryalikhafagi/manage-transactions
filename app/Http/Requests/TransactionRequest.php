<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\BaseRequest;

class TransactionRequest extends BaseRequest
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
            'due_on' =>  "required|date",
            'vat' =>  "required",
            'is_vat_inclusive' => "required|in:0,1",
        ];
    }
}
