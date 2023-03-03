<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !Auth::guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'style' => 'required|string',
            'brand' => 'required|string',
            'url' => 'nullable|string|max:255',
            'product_type' => 'required|string|max:255',
            'shipping_price' => 'required|numeric',
            'note' => 'nullable|string'
        ];
    }
    /**
     * Handle a passed validation attempt.
     */
    protected function prepareForValidation(): void
    {
        // store shipping price in cents
        $this->merge(['shipping_price' => floatval($this->input('shipping_price')) * 100]);
    }
}
