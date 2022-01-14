<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Livewire\Commands\CopyCommand;

class HomeController extends Controller
{
    public function view(){
        $claims = auth()->user()->claims()->latest()->get();
        return view("pages.user.home", compact("claims"));
    }    

    public function changePasswordView(){
        return view("pages.user.changepwd");
    }
}