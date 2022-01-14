<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\FuncCall;

class AdminAuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if(!auth("admin")
            ->attempt($request->validated(), $request->remember === "on" ? true : false)){
            return redirect()
                    ->route("admin.login.view")
                    ->with("login.error", "Incorrect email or password!")
                    ->withInput(["email" => $request->email]);
        }
        return redirect()->route("admin.dashboard");
    }

    public function changePwd(){
        return view("pages.change-password");
    }

    public function changePassword(ChangePasswordRequest $request){
        auth("admin")->user()->update(['password'=> Hash::make($request->new_password)]);
        return redirect()->route("admin.dashboard");
    }

    public function logout(){
        auth("admin")->logout();
        return redirect()->route("admin.login.view");
    }
}