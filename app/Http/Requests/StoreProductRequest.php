<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:5|max:20|unique:products,name,'.$this->id,
            'status' => 'required',
            "slug" => "required",
            "price" => "required",
            "discount_price" => "required",
            "short_description" => "required",
            "qty" => "required",
            "shipping" => "required",
            "weight" => "required",
            "description" => "required",
            "information" => "required",
            "product_categories_id" => "required"
        ];
    }
    public function message(): array
    {
        return [
            'name.required' => 'Vui long dien ten !',
            'name.min' => 'Ten phai co tren 3 ky tu',
            'name.max' => 'Ten chi co toi da 20 ki tu',
            'status.required' => 'Vui long chon trang thai',
            "slug.required" => "required",
            "price.required" => "required",
            "discount_price.required" => "required",
            "short_description.required" => "required",
            "qty.required" => "required",
            "shipping.required" => "required",
            "weight.required" => "required",
            "description.required" => "required",
            "information.required" => "required",
            "product_categories_id.required" => "required"
        ];
    }
}
