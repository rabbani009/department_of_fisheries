<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
    use HasFactory;
    public function getEditUnion($data)
    {
        return static::where('divisionId', $data->divisionId)->where('districtId', $data->districtId)->where('upazilaId', $data->upazilaId)->where('municipalityId', '<', 1)->get();
    }
  
    public function getPresentEditUnion($data)
    {
        return static::where('divisionId', $data->presentDivisionId)->where('districtId', $data->presentDistrictId)->where('upazilaId', $data->presentUpazilaId)->where('municipalityId', '<', 1)->get();
    }
    public function getEditWard($data)
    {
        return static::where('divisionId', $data->divisionId)->where('districtId', $data->districtId)->where('upazilaId', $data->upazilaId)->where('municipalityId', $data->municipalityId)->get();
    }
    public function getPresentEditWard($data)
    {
        return static::where('divisionId', $data->presentDivisionId)->where('districtId', $data->presentDistrictId)->where('upazilaId', $data->presentUpazilaId)->where('municipalityId', $data->presentMunicipalityId)->get();
    }
    public function getPermanentUnion($data)
    {
        return static::where('divisionId', $data->divisionId)->where('districtId', $data->districtId)->where('upazilaId', $data->upazilaId)->where('municipalityId', $data->municipalityId)->where('unionId', $data->unionId)->first();
    }
    public function getPermanentWard($data)
    {
        return static::where('divisionId', $data->divisionId)->where('districtId', $data->districtId)->where('upazilaId', $data->upazilaId)->where('municipalityId', $data->municipalityId)->where('unionId', $data->wardId)->first();
    }
   
    public function getPresentUnion($data)
    {
        return static::where('divisionId', $data->presentDivisionId)->where('districtId', $data->presentDistrictId)->where('upazilaId', $data->presentUpazilaId)->where('municipalityId', $data->presentMunicipalityId)->where('unionId', $data->presentUnionId)->first();
    }
    public function getPresentWard($data)
    {
        return static::where('divisionId', $data->presentDivisionId)->where('districtId', $data->presentDistrictId)->where('upazilaId', $data->presentUpazilaId)->where('municipalityId', $data->presentMunicipalityId)->where('unionId', $data->presentAddressWard)->first();
    }
    // for report
    public function getReportUnion($divisionId, $districtId, $upazilaId)
    {
        return static::where('divisionId', $divisionId)->where('districtId', $districtId)->where('upazilaId', $upazilaId)->where('municipalityId', 0)->get();
    }
    public function getUnionName($data)
    {
        return static::where('divisionId', $data->divisionId)->where('districtId', $data->districtId)->where('upazilaId', $data->upazilaId)->where('municipalityId', 0)->where('unionId', $data->unionId)->first();
    }

}
