<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'amount' => (float) $this->amount,
            'due_on' => $this->due_on,
            'vat' => (float) $this->vat,
            'is_vat_inclusive' => (boolean) $this->is_vat_inclusive,
            'status' => $this->status

        ];
    }
}
