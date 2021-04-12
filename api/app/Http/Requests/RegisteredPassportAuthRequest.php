<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisteredPassportAuthRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'bail|required|min:4',
            'email' => 'bail|required|unique:App\Models\User|email',
            'password' => 'bail|required|min:8',
        ];
    }
}
