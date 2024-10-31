<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SecretRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => 'required',
            'expires_in' => 'nullable|in:24,48,72,168',
            'max_views' => 'required|integer|min:1|max:15',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
