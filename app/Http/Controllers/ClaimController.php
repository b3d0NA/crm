<?php

namespace App\Http\Controllers;

use App\Claim;
use App\CustomerNumber;
use App\Http\Requests\ClaimRequest;
use App\Item;
use App\ItemGroup;
use App\ItemNumber;
use App\Mail\DecisionUpdated;
use App\Mail\UserCreated;
use App\SalesChannel;
use App\User;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Monarobase\CountryList\CountryListFacade;
class ClaimController extends Controller
{
    public function index(){
        $decisions = Claim::whereNotNull("decision")->distinct('decision')->pluck("decision");
        return view("pages.apps.claims", compact("decisions"));
    }

    public function userView(){
        $item_numbers = Item::latest()->pluck("number");
        $countries = CountryListFacade::getList("en");
        $channels = SalesChannel::latest()->pluck("country");
        return view("pages.user.claim", compact("countries", "item_numbers", "channels"));
    }

    public function edit(Claim $claim){
        $groups =  ItemGroup::latest()->pluck("code");
        return view("pages.apps.claim-edit", compact("claim", "groups"));
    }

    public function update(Request $request, Claim $claim){
        $claim->update($request->all(), ["group"]);
        if($request->filled("decision")){
            $claim->update(["is_escalated" => 0]);
            Mail::to($claim->user->email)
            ->queue(new DecisionUpdated($request->decision, $claim));
        }
        return redirect()->route("claims.index");
    }

    public function store(ClaimRequest $request){
        $password = Str::random(8);
        $hashed_random_password = Hash::make($password);
        $images = [];
        if($request->has("image")){
            foreach($request->file("image") as $image){
                $image_file = $image->store("public/products");
                array_push($images, $image_file);
            }
        }
        if(!auth()->check()){
            $user = User::create([
                "name" => $request->validated()["customer_name"],
                "email" => $request->validated()["email"],
                "password" => $hashed_random_password
            ]);
            $claim_no = "Q".$user->id."-".now()->year;
            Claim::create(array_merge(Arr::except($request->validated(), ["email"]), [
                "date" => now()->format('Y-m-d'),
                "user_id" => $user->id,
                "claim_no" => $claim_no,
                "image" => implode("|", $images)
            ]));
            try{
                Mail::to($user->email)
                ->queue(new UserCreated($user, $password));
            }catch(Exception $e){
                return back()->withErrors([$e->getMessage()]);
            }
            auth()->attempt(array_merge($request->only("email"), ["password" => $password]));
        }else{
            $randomClaim = random_int(10000, 99999);
            $claim_no = "Q".auth()->id().$randomClaim."-".now()->year;
            auth()->user()->claims()->create(array_merge(Arr::except($request->validated(), ["email"]), [
                "date" => now()->format('Y-m-d'),
                "claim_no" => $claim_no,
                "image" => implode("|", $images)
            ]));
        }
        
        
        return redirect()->route("home");
    }

    public function escalateByUser(Claim $claim){
        if(now()->diffInDays($claim->created_at) >= 14 && !empty($claim->decision)){
            $claim->update(["is_escalated" => 2]);
        }else{
            abort(403);
        }
        return redirect()->route("home");
    }
}