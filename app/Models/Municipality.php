<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;
    public function get_division()
    {
        return $this->belongsTo(Division::class, 'divisionId', 'divisionId');
    }
    public function getEditMunicipality($data){
        return static::where('divisionId',$data->divisionId)->where('districtId',$data->districtId)->where('upazilaId',$data->upazilaId)->get();
    }
    public function getPresentEditMunicipality($data){
        return static::where('divisionId',$data->presentDivisionId)->where('districtId',$data->presentDistrictId)->where('upazilaId',$data->presentUpazilaId)->get();
    }
    public function getPermanentMunicipality($data){
        return static::where('divisionId',$data->divisionId)->where('districtId',$data->districtId)->where('upazilaId',$data->upazilaId)->where('municipalityId',$data->municipalityId)->first();
    }
    public function getPresentMunicipality($data){
        // return $data;
        return static::where('divisionId',$data->presentDivisionId)->where('districtId',$data->presentDistrictId)->where('upazilaId',$data->presentUpazilaId)->where('municipalityId',$data->presentMunicipalityId)->first();
    }
      // for report
      public function getReportMunicipality($divisionId, $districtId, $upazilaId)
      {
          return static::where('divisionId', $divisionId)->where('districtId', $districtId)->where('upazilaId', $upazilaId)->get();
      }

      public function getMunicipalityName($data)
      {
          return static::where('divisionId', $data->divisionId)->where('districtId', $data->districtId)->where('upazilaId', $data->upazilaId)->where('municipalityId', $data->municipalityId)->first();
      }
}
