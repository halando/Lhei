<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(UserRegisterChecker $request){
        $request->validated();
        $input = $request->all();
        $input["password"]=bcrypt($input["password"]);
        $user = User::create($input);
        $success["name"]=$user->name;
        return $this ->sendResponse($success, "Sikeres Regisztráció");
    }
    public function login(){

    }
    public function logout(){

    }
}
