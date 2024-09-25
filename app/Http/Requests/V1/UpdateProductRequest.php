<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
        $method = $this->method(); //check if put or patch

        return [
            'id' => ['sometimes', 'required'],
            'name' => ['sometimes', 'required', Rule::unique('products')],
            'description' => ['sometimes', 'required'],
            'brand' => ['sometimes', 'required'],
            'type' => ['sometimes', 'required'],
            'price' => ['sometimes', 'required'],
            'stockQuantity' => ['sometimes', 'required']
        ];
    }

    public function prepareForValidation()
    {
        if ($this->stockQuantity) {
            $this->merge([
                'stock_quantity' => $this->stockQuantity
            ]);
        }
    }
}
