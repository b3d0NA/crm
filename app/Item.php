<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ["number", "description"];

    public function group(){
        return $this->belongsTo(ItemGroup::class, "group_id");
    }
}