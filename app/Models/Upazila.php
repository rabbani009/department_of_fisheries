<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
    use HasFactory;
    public function get_division()
    {
        return $this->belongsTo(Division::class, 'divisionId', 'divisionId');
    }
    public function get_district()
    {
        return $this->belongsTo(District::class, 'districtId', 'districtId');
    }
    public function getUpazilaList(){
      return static::select('id','divisionId','districtId','upazilaId','upazilaBng','upazilaEng')->orderBy('id','ASC')->get();
   }
    public function getPermanentUpazila($data){
       return static::where('divisionId',$data->divisionId)->where('districtId',$data->districtId)->where('upazilaId',$data->upazilaId)->first();
    }
    public function getPresentUpazila($data){
      //  return $data;
       return static::where('divisionId',$data->presentDivisionId)->where('districtId',$data->presentDistrictId)->where('upazilaId',$data->presentUpazilaId)->first();
    }
    public function getEditUpazila($data){
      return static::where('divisionId',$data->divisionId)->where('districtId',$data->districtId)->get();
   }
    public function getPresentEditUpazila($data){
      return static::where('divisionId',$data->presentDivisionId)->where('districtId',$data->presentDistrictId)->get();
   }
   // report
    public function getReportUpazila($divisionId,$districtId){
      return static::where('divisionId',$divisionId)->where('districtId',$districtId)->get();
   }
    public function getReportUpazilaName($divisionId,$districtId,$upazilaId){
      return static::where('divisionId',$divisionId)->where('districtId',$districtId)->where('upazilaId',$upazilaId)->first();
   }
    public function getUpazilaName($data){
      return static::where('divisionId',$data->divisionId)->where('districtId',$data->districtId)->where('upazilaId',$data->upazilaId)->first();
   }
}
