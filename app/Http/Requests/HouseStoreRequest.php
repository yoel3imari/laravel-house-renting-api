<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HouseStoreRequest extends FormRequest
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
            //"desc" => "required",
            //"rent_price" => "required|min:0",
            //"owner" => "required|exists:users,id"
        ];
    }

    public function messages()
    {
        return [
            //"desc" => "this field is reuquired",
            //"rent_price.required" => "this field is reuquired",
            //"rent_price.min" => "The min value of this field is 0",
            //"owner.exists" => "No user matching the provided ID",
        ];
    }


}
