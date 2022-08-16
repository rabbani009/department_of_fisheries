<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeOfFishing extends Model
{
    use HasFactory;
    
    public function getTimeOfFishings(){
      return static::select('id','timeOfFishingBng','timeOfFishingEng')->orderBy('id','ASC')->get();
    }
}
