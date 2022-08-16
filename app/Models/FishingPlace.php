<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FishingPlace extends Model
{
    use HasFactory;
    
    public function getFishingPlace(){
        return static::orderBy('id','ASC')->get();
    }
}
