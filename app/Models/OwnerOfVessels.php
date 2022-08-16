<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerOfVessels extends Model
{
    use HasFactory;
    public function getOwnerOfVessels(){
        return static::orderBy('id','ASC')->get();
    }
}
