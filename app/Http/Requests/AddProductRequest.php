<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:products',
            'qty' => 'required|integer',
            'price' => 'required|integer',
            'color_id' => 'required|exists:colors,id',
            'size_id' => 'required|exists:sizes,id',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'childcategory_id' => 'required|exists:childcategories,id',
            'brand_id' => 'required|exists:brands,id',
            'description' => 'required|string|max:5000|not_in:<p><br></p>',
            'thumbnail' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'first_image' => 'image|mimes:png,jpg,jpeg|max:2048',
            'second_image' => 'image|mimes:png,jpg,jpeg|max:2048',
            'third_image' => 'image|mimes:png,jpg,jpeg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'description.not_in' => 'The description field is required',
            'color_id.required' => 'Please choose a color',
            'size_id.required' => 'Please choose a size',
            'category_id.required' => 'Please choose a category',
            'subcategory_id.required' => 'Please choose a subcategory',
            'childcategory_id.required' => 'Please choose a child category',
            'brand_id.required' => 'Please choose a brand',
            'thumbnail.image' => 'The thumbnail must be an image',
            'thumbnail.max' => 'The thumbnail must not be greater than 2MB',
            'first_image.image' => 'The first image must be an image',
            'first_image.max' => 'The first image must not be greater than 2MB',
            'second_image.image' => 'The second image must be an image',
            'second_image.max' => 'The second image must not be greater than 2MB',
            'third_image.image' => 'The third image must be an image',
            'third_image.max' => 'The third image must not be greater than 2MB',
        ];
    }
}
