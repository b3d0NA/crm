<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if(!auth()
            ->attempt($request->validated(), $request->remember === "on" ? true : false)){
            return redirect()
                    ->route("user.login.view")
                    ->with("login.error", "Incorrect email or password!")
                    ->withInput(["email" => $request->email]);
        }
        return redirect()->route("home");
    }
    public function logout(){
        auth()->logout();
        return redirect()->route("home");
    }

    public function changePassword(ChangePasswordRequest $request){
        auth()->user()->update(['password'=> Hash::make($request->new_password)]);
        return redirect()->route("home");
    }
}