<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    public function getDivisionList(){
       return static::get();
    }
    public function getDivisionName($id){
       return static::where('divisionId',$id)->select('divisionEng','divisionBng')->first();
    }
    public function getDivision($data){
       return static::where('divisionId',$data->divisionId)->first();
    }
}
