<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfEmploymentStatusInVessels extends Model
{
    use HasFactory;

    public function getTypeOfEmploymentStatusinVessels(){
        return static::orderBy('id','ASC')->get();
    }
}
