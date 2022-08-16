<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FishingEquipment extends Model
{
    use HasFactory;

    public function getFishingEquipment(){
        return static::orderBy('id','ASC')->get();
    } 
}
