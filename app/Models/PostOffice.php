<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostOffice extends Model
{
    use HasFactory;
    public function getPermanentPostOffice($data){
        return static::where('divisionId',$data->divisionId)->where('districtId',$data->districtId)->where('upazilaId',$data->upazilaId)->where('postId',$data->postOfficeId)->first();
    }
    public function getPresentPostOffice($data){
        return static::where('divisionId',$data->presentDivisionId)->where('districtId',$data->presentDistrictId)->where('upazilaId',$data->presentUpazilaId)->where('postId',$data->presentPostoffice)->first();
    }
    public function getEditPostOffice($data){
        return static::where('divisionId',$data->divisionId)->where('districtId',$data->districtId)->where('upazilaId',$data->upazilaId)->get();
    }
  
    public function getPresentEditPostOffice($data){
        return static::where('divisionId',$data->presentDivisionId)->where('districtId',$data->presentDistrictId)->where('upazilaId',$data->presentUpazilaId)->get();
    }
}
