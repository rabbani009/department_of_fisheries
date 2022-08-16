<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeficiencyPeriod extends Model
{
    use HasFactory;

    public function getDeficiencyPeriod(){
        return static::orderBy('id','ASC')->get();
    }
}
