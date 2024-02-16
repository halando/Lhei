<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Users extends FormRequest
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
            "username "=>"required",
            "fullname"=>"required|numeric",
            "email"=>"required",
            "tagsbegin"=>"required",
            "permission"=>"required"
        ];
    }
    
    public function messages(){
        return [
            "username.required"=>"Username kitöltése kötelező",
            "fullname.required"=>"Fullname kötelező",
            "email.required"=>"Email cím megadása kötelező",
            "tagsbegin.required"=>"Tagsbegin kitöltése kötelező",
            "permission.required"=>"Permission kitöltése kötelező",
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
