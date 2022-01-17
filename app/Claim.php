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

    public function decisionBg($value){
        if (in_array($value, ['approved', 'Approved', 'approve', 'Approve'])){
            return ["bg-success", "#05a34a"];
        }elseif (in_array($value, ['not-approved', 'not approved', 'Not approved', 'Not Approved', 'Declined', 'declined'])){
            return ["bg-danger", "#ff3366"];
        }elseif(in_array($value, ['Under review', 'Under Review'])){
            return ["bg-primary", "#6571ff"];
        }elseif(!empty($value)){
            return ["bg-warning", "#fbbc06"];
        }
    }
}