<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FishCategory extends Model
{
    use HasFactory;
    
    public function getFishCategory(){
        return static::orderBy('id','ASC')->get();
    }
}
