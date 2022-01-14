<?php

namespace App\Http\Controllers;

use App\SalesChannel;
use Illuminate\Http\Request;

class SalesChannelController extends Controller
{
    public function index(){
        $channels = SalesChannel::latest()->get();
        return view("pages.sales_channel", compact("channels"));
    }

    public function store(Request $req)
    {
        $req->validate([
            "country" => "required"
        ]);
        SalesChannel::create($req->only("country"));
        return redirect()->route("sales.channel");
    }

    public function destroy(SalesChannel $sales){
        dd($sales);
    }
}