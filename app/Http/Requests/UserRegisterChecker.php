<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterChecker extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name.required"=>"Name required",
            "name.max"=>"Name too long",
            "email.required"=>"Email required",
            "email.email"=>"Email wrong format",
            "email.unique"=>"Az email már használatban van",
            "password.required"=>"Password required",
            "password.min"=>"Password too short",
            "confirm_password.required"=>"Confirm Password required",
            "confirm_password.same"=>"Passwords don't match",

        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            "success"=>false,
            "message"=>"Adatbeviteli hiba",
            "data"=>$validator->errors()
        ]));
        
    }
}
