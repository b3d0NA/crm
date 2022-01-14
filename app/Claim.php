<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $appends = [
        "email",
    ];

    protected $dates = [
        "date",
        "purchased_date",
        "customer_order_date",
    ];
    
    public function getEmailAttribute()
    {
        return $this->user->email;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}