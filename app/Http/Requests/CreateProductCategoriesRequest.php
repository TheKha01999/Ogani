<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductCategoriesRequest extends FormRequest
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
            'name' => 'required|min:5|max:20|unique:product_categories,name',
            'status' => 'required',
        ];
    }
    public function message(): array
    {
        return [
            'name.required' => 'Vui long dien ten !',
            'name.min' => 'Ten phai co tren 3 ky tu',
            'name.max' => 'Ten chi co toi da 20 ki tu',
            'status.required' => 'Vui long chon trang thai'
        ];
    }
}
