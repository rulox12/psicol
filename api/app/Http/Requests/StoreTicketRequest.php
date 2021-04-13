<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'event' => 'bail|required|max:30',
            'charge' => 'bail|required|numeric',
            'event_date' => 'bail|required|date',
            'buyer_id' => 'bail|exists:App\Models\Buyer,id',
        ];
    }
}
