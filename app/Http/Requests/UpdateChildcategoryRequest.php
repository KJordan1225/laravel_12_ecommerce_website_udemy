<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChildcategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:childcategories,name,'.$this->childcategory->id,
            'subcategory_id' => 'required|integer|exists:subcategories,id'
        ];
    }

    public function messages() : array
    {
        return [
            'subcategory_id.required' => 'Please choose a subcategory'
        ];
    }
}
