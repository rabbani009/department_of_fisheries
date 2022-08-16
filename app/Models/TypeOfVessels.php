<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfVessels extends Model
{
    use HasFactory;

    public function getTypeOfVessels(){
        return static::orderBy('id','ASC')->get();
    }
}
