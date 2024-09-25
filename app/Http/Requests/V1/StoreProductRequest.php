<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', Rule::unique('products')],
            'description' => 'required',
            'brand' => 'required',
            'type' => 'required',
            'price' => 'required',
            'stockQuantity' => 'required'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'stock_quantity' => $this->stockQuantity
        ]);
    }
}
