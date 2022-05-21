<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "product_id" => "required|unique:product_user",
            "color" => "required",
            "quantity" => "required",
            "price" => "required",
        ];
    }

    public function messages()
    {
        return [
            "product_id.unique" => "The product is already added to your cart!",
        ];
    }
}
