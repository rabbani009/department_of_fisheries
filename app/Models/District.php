<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    public function get_division()
    {
        return $this->belongsTo(Division::class, 'divisionId', 'divisionId');
    }
    public function getAllDistrictList(){
        return static::orderBy('divisionId','ASC')->get();
    }
    public function getDistrictList(){
        return static::orderBy('districtEng','ASC')->get();
    }
    public function getEditDistrict($id){
        return static::where('divisionId',$id)->orderBy('districtEng','ASC')->get();
    }
    public function getReportDistrict($id){
        return static::where('divisionId',$id)->orderBy('districtEng','ASC')->get();
    }
    public function getPresentEditDistrict($id){
        return static::where('divisionId',$id)->orderBy('districtEng','ASC')->get();
    }
    // report
    public function getReportDistrictName($id){
        return static::where('districtId',$id)->first();
    }
    public function getDistrictName($data){
        return static::where('divisionId',$data->divisionId)->where('districtId',$data->districtId)->first();
    }
}
