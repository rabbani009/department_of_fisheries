<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;
    public function getEditVillage($data){
        return static::where('divisionId',$data->divisionId)->where('districtId',$data->districtId)->where('upazilaId',$data->upazilaId)->where('municipalityId', '<', 1)->where('unionId',$data->unionId)->get();
    }
    public function getPresentEditVillage($data){
        return static::where('divisionId',$data->presentDivisionId)->where('districtId',$data->presentDistrictId)->where('upazilaId',$data->presentUpazilaId)->where('municipalityId', '<', 1)->where('unionId',$data->presentUnionId)->get();
    }
    public function getPermanentVillage($data){
        return static::where('divisionId',$data->divisionId)->where('districtId',$data->districtId)->where('upazilaId',$data->upazilaId)->where('municipalityId', '<', 1)->where('unionId',$data->unionId)->where('villageId',$data->villageId)->first();
    }
    
    public function getPresentVillage($data){
        return static::where('divisionId',$data->presentDivisionId)->where('districtId',$data->presentDistrictId)->where('upazilaId',$data->presentUpazilaId)->where('municipalityId',$data->presentMunicipalityId)->where('unionId',$data->presentUnionId)->where('villageId',$data->presentAddressVillage)->first();
    }
}
