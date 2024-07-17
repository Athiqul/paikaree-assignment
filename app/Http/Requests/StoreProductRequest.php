<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

     //Validation for incoming product request
    public function rules(): array
    {
        return [
            'name'=>['required','string','max:255','min:3','unique:products,name'],
            "price"=>['required','numeric'],
            "discount"=>['required','numeric','lt:price'],
            "thumbnail"=>["required",'image','mimes:png,jpg,webp',"max:2048"],
            "product_images.*"=>["nullable","image","mimes:png,jpg,webp","max:2048"]
        ];
    }


    //Handling Error Message

    public function messages(): array
    {
        return [
            'name.required' => 'Please provide the product name.',
            'name.string' => 'The product name must be a string.',
            'name.max' => 'The product name must not exceed 255 characters.',
            'name.min' => 'The product name must be at least 3 characters long.',
            'name.unique'=>"Same Name product already created",
            'price.required' => 'Please provide the product price.',
            'price.numeric' => 'The product price must be a number.',
            'discount.required' => 'Please provide the product discount.',
            'discount.numeric' => 'The product discount must be a number.',
            'discount.lt' => 'The product discount must be less than the price.',
            'thumbnail.required' => 'Please upload a product thumbnail image.',
            'thumbnail.image' => 'The thumbnail must be an image.',
            'thumbnail.mimes' => 'The thumbnail must be a PNG, JPG, or WEBP image.',
            'thumbnail.max' => 'The thumbnail may not be larger than 2MB.',
            'product_images.*.image' => 'All product images must be images.',
            'product_images.*.mimes' => 'All product images must be PNG, JPG, or WEBP images.',
            'product_images.*.max' => 'All product images may not be larger than 2MB.',
        ];
    }

    //Override Laravel Default Validation error handling method
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation error',
            'errors' => $validator->errors(),
        ],200)); // HTTP status code 422 for Unprocessable Entity
    }

}
