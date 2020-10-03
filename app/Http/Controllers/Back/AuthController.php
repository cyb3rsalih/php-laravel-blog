<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth; 

class AuthController extends Controller
{
    public function login(){
        return view("back.auth.login");
    }

    public function loginPost(Request $request){
    if(Auth::attempt(["email"=>$request->email,"password"=>$request->password])){
        return "Başarılı"; die;
    }
    return "Hata...";
    }

}
