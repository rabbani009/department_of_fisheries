<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FishSalePlaces extends Model
{
    use HasFactory;

    public function getFishSalePlaces(){
        return static::orderBy('id','ASC')->get();
    }
}
