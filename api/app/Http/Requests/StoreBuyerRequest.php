<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBuyerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'bail|required|max:30',
            'surname' => 'bail|required|max:30',
            'email' => 'bail|required|max:50|unique:App\Models\Buyer|email',
            'mobile' => 'bail|required|max:20',
        ];
    }
}
