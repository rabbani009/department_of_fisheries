<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HowToFishing extends Model
{
    use HasFactory;

    public function getHowToFishing(){
        return static::orderBy('id','ASC')->get();
    }
}
