<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearlySaving extends Model
{
    use HasFactory;

    public function getYearlySaving(){
        return static::orderBy('id','ASC')->get();
    }
}
