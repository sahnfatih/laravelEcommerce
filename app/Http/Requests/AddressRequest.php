<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "city" => "required|min:3",
            "district" => "required|min:3",
            "zipcode" => "required|min:3",
            "address" => "required|min:10",
            "is_default" => "sometimes|boolean"
        ];
    }

    public function messages()
    {
        return [
            "city.required" => "Bu alan zorunludur.",
            "city.min" => "Bu alan en az 3 karakterden oluşmalıdır.",
            "district.required" => "Bu alan zorunludur.",
            "district.min" => "Bu alan en az 3 karakterden oluşmalıdır.",
            "zipcode.required" => "Bu alan zorunludur.",
            "zipcode.min" => "Bu alan en az 3 karakterden oluşmalıdır.",
            "address.required" => "Bu alan zorunludur.",
            "address.min" => "Bu alan en az 10 karakterden oluşmalıdır.",
        ];
    }
}
