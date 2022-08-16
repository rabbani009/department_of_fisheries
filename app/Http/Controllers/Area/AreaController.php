<?php

namespace App\Http\Controllers\Area;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use App\Models\Municipality;
use App\Models\PostOffice;
use App\Models\Union;
use App\Models\Upazila;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaController extends Controller
{
    private $division,
    $upazila,
    $union,
    $municipality,
    $district;
    public function __construct(
        Division $division,
        Upazila $upazila,
        Union $union,
        Municipality $municipality,
        District $district
    ) {
        $this->middleware('auth');
        $this->middleware('preventBackHistory'); 
        $this->division = $division;
        $this->district = $district;
        $this->upazila = $upazila;
        $this->municipality = $municipality;
        $this->union = $union;
    }
    public function divisionList()
    {
        $divisionList = $this->division->getDivisionList();
        return view('admin.division.index')->with([
            'divisionList' => $divisionList
        ]);
    }

    public function createDivision(Request $request)
    {   
        $getId= Auth::user()->id;
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        $randnum = rand(10,99);
        $add = new Division();
        $add->divisionId = $randnum;
        $add->divisionEng = $request->divisionEng;
        $add->divisionBng = $request->divisionBng;
        $add->dataCreateBy = $getId;
        $add->dataCreateIp = $ipaddress;
        $add->save();
        if ($add) {
            flash('Successfully Added')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function updateDivision(Request $request)
    {   
        $getId= Auth::user()->id;
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        $randnum = rand(10,99);
        $add = Division::find($request->id);
        $add->divisionId = $randnum;
        $add->divisionEng = $request->divisionEng;
        $add->divisionBng = $request->divisionBng;
        $add->dataUpdateBy = $getId;
        $add->dataUpdateIp = $ipaddress;
        $add->save();
        if ($add) {
            flash('Successfully Added')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function deleteDivision($id)
    {
        Division::find($id)->delete();
        flash('Successfully Deleted')->success();
        return back();
    }
    // district
    public function districtList()
    { 
        $divisionList = $this->division->getDivisionList();
        $districtList = $this->district->getAllDistrictList();
        return view('admin.district.index')->with([
            'districtList' => $districtList,
            'divisionList' => $divisionList,
        ]);
    }
    public function createDistrict(Request $request)
    {   
        $getId= Auth::user()->id;
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        $randnum = rand(100,999);
        $add = new District();
        $add->districtId = $randnum;
        $add->divisionId = $request->divisionId;
        $add->districtEng = $request->districtEng;
        $add->districtBng = $request->districtBng;
        $add->dataCreateBy = $getId;
        $add->dataCreateIp = $ipaddress;
        $add->save();
        if ($add) {
            flash('Successfully Added')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function updateDistrict(Request $request)
    {   
        // return Division::find($request->id);
        $getId= Auth::user()->id;
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        $add = District::find($request->id);
        // return $add;
        // $add->districtId = $add->districtId;
        $add->divisionId = $request->divisionId;
        $add->districtEng = $request->districtEng;
        $add->districtBng = $request->districtBng;
        $add->dataUpdateBy = $getId;
        $add->dataUpdateIp = $ipaddress;
        $add->save();
        if ($add) {
            flash('Successfully Added')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function deleteDistrict($id)
    {
        District::find($id)->delete();
        flash('Successfully Deleted')->success();
        return back();
    }
    // upazila
    public function upazilaList()
    { 
        $divisionList = $this->division->getDivisionList();
        return view('admin.upazila.index')->with([
            'divisions' => $divisionList,
        ]);
    }
    public function createUpazila()
    { 
        $divisionList = $this->division->getDivisionList();
        return view('admin.upazila.create')->with([
            'divisionList' => $divisionList,
        ]);
    }

    public function storeUpazila(Request $request)
    {   
        $getId= Auth::user()->id;
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        $randnum = rand(10,99);
        $add = new Upazila();
        $add->upazilaId = $randnum;
        $add->divisionId = $request->divisionId;
        $add->districtId = $request->districtId;
        $add->upazilaEng = $request->upazilaEng;
        $add->upazilaBng = $request->upazilaBng;
        $add->dataCreateBy = $getId;
        $add->dataCreateIp = $ipaddress;
        $add->save();
        if ($add) {
            flash('Successfully Added')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function editUpazila($id)
    { 
        $data = Upazila::findOrFail($id);
        $divisionList = $this->division->getDivisionList();
        return view('admin.upazila.edit')->with([
            'data' => $data,
            'divisionList' => $divisionList,
        ]);
    }
    public function updateUpazila(Request $request)
    {   
        // return Division::find($request->id);
        $getId= Auth::user()->id;
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        $add = Upazila::find($request->id);
        // return $add;
        $add->divisionId = $request->divisionId;
        $add->districtId = $request->districtId;
        $add->upazilaEng = $request->upazilaEng;
        $add->upazilaBng = $request->upazilaBng;
        $add->dataUpdateBy = $getId;
        $add->dataUpdateIp = $ipaddress;
        $add->save();
        if ($add) {
            flash('Successfully Added')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function deleteUpazila($id)
    {
        Upazila::find($id)->delete();
        flash('Successfully Deleted')->success();
        return back();
    }
    // municipality
    public function municipalityList()
    { 
        $divisions = $this->division->getDivisionList();
        return view('admin.municipality.index')->with([
            'divisions' => $divisions,
        ]);
    }
    public function createMunicipality()
    { 
        $divisionList = $this->division->getDivisionList();
        return view('admin.municipality.create')->with([
            'divisionList' => $divisionList,
        ]);
    }

    public function storeMunicipality(Request $request)
    {   
        // return $request->all();
        $getId= Auth::user()->id;
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        $randnum = rand(1000,9999999);
        $rand = rand(10,100);
        $add = new Municipality();
        $add->randomId = $randnum;
        $add->municipalityId = $rand;
        $add->divisionId = $request->divisionId;
        $add->districtId = $request->districtId;
        $add->upazilaId = $request->upazilaId;
        $add->municipalityBangla = $request->municipalityBangla;
        $add->municipalityEnglish = $request->municipalityEnglish;
        $add->dataCreateBy = $getId;
        $add->dataCreateIp = $ipaddress;
        $add->save();
        if ($add) {
            flash('Successfully Added')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function editMunicipality($id)
    { 
        $data = Municipality::findOrFail($id);
        $divisionList = $this->division->getDivisionList();
        $getDistrict = $this->district->getDistrictName($data);
        $getUpazila = $this->upazila->getUpazilaName($data);
        return view('admin.municipality.edit')->with([
            'data' => $data,
            'getDistrict' => $getDistrict,
            'getUpazila' => $getUpazila,
            'divisionList' => $divisionList,
        ]);
    }
    public function updateMunicipality(Request $request)
    {   
        // return $request->all();
        // return Division::find($request->id);
        $getId= Auth::user()->id;
        // return $getId; 
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        $add = Municipality::find($request->id);
        $add->divisionId = $request->divisionId;
        $add->districtId = $request->districtId;
        $add->upazilaId = $request->upazilaId;
        $add->municipalityBangla = $request->municipalityBangla;
        $add->municipalityEnglish = $request->municipalityEnglish;
        $add->dataUpdateBy = $getId;
        $add->dataUpdateIp = $ipaddress;
        $add->save();
        if ($add) {
            flash('Successfully Added')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function deleteMunicipality($id)
    {
        Municipality::find($id)->delete();
        flash('Successfully Deleted')->success();
        return back();
    }
    // ward
    public function wardList()
    { 
        $divisions = $this->division->getDivisionList();
        return view('admin.ward.index')->with([
            'divisions' => $divisions,
        ]);
    }
    public function createWard()
    { 
        $divisionList = $this->division->getDivisionList();
        return view('admin.ward.create')->with([
            'divisionList' => $divisionList,
        ]);
    }

    public function storeWard(Request $request)
    {   
        // return $request->all();
        $getId= Auth::user()->id;
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        // $randnum = rand(1000,9999999);
        // $rand = rand(1,100);
        $add = new Union();
        $add->unionId = $request->unionId;
        $add->divisionId = $request->divisionId;
        $add->districtId = $request->districtId;
        $add->upazilaId = $request->upazilaId;
        $add->municipalityId = $request->municipalityId;
        $add->unionBng = $request->unionBng;
        $add->unionEng = $request->unionEng;
        $add->dataCreateBy = $getId;
        $add->dataCreateIp = $ipaddress;
        $add->save();
        if ($add) {
            flash('Successfully Added')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function editWard($id)
    { 
        $data = Union::findOrFail($id);
        $divisionList = $this->division->getDivisionList();
        $getDivision = $this->division->getDivision($data);
        $getDistrict = $this->district->getDistrictName($data);
        $getUpazila = $this->upazila->getUpazilaName($data);
        $getMunicipality = $this->municipality->getMunicipalityName($data);
        return view('admin.ward.edit')->with([
            'data' => $data,
            'divisionList' => $divisionList,
            'getDivision' => $getDivision,
            'getDistrict' => $getDistrict,
            'getUpazila' => $getUpazila,
            'getMunicipality' => $getMunicipality,
        ]);
    }
    public function updateWard(Request $request)
    {   
        $getId= Auth::user()->id;
        // return $getId; 
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        $add = Union::find($request->id);
        $add->unionId = $request->unionId;
        $add->divisionId = $request->divisionId;
        $add->districtId = $request->districtId;
        $add->upazilaId = $request->upazilaId;
        $add->municipalityId = $request->municipalityId;
        $add->unionBng = $request->unionBng;
        $add->unionEng = $request->unionEng;
        $add->dataUpdateBy = $getId;
        $add->dataUpdateIp = $ipaddress;
        $add->save();
        if ($add) {
            flash('Successfully Added')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function deleteWard($id)
    {
        Union::find($id)->delete();
        flash('Successfully Deleted')->success();
        return back();
    }
    // union
    public function unionList()
    { 
        $divisions = $this->division->getDivisionList();
        return view('admin.union.index')->with([
            'divisions' => $divisions,
        ]);
    }
    public function createUnion()
    { 
        $divisionList = $this->division->getDivisionList();
        return view('admin.union.create')->with([
            'divisionList' => $divisionList,
        ]);
    }

    public function storeUnion(Request $request)
    {   
        // return $request->all();
        $getId= Auth::user()->id;
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        // $randnum = rand(1000,9999999);
        // $rand = rand(1,100);
        $add = new Union();
        $add->unionId = $request->unionId;
        $add->divisionId = $request->divisionId;
        $add->districtId = $request->districtId;
        $add->upazilaId = $request->upazilaId;
        $add->municipalityId = 0;
        $add->unionBng = $request->unionBng;
        $add->unionEng = $request->unionEng;
        $add->dataCreateBy = $getId;
        $add->dataCreateIp = $ipaddress;
        $add->save();
        if ($add) {
            flash('Successfully Added')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function editUnion($id)
    { 
        $data = Union::findOrFail($id);
        $divisionList = $this->division->getDivisionList();
        $getDivision = $this->division->getDivision($data);
        $getDistrict = $this->district->getDistrictName($data);
        $getUpazila = $this->upazila->getUpazilaName($data);
        return view('admin.union.edit')->with([
            'data' => $data,
            'divisionList' => $divisionList,
            'getDivision' => $getDivision,
            'getDistrict' => $getDistrict,
            'getUpazila' => $getUpazila,
        ]);
    }
    public function updateUnion(Request $request)
    {   
        $getId= Auth::user()->id;
        // return $getId; 
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        $add = Union::find($request->id);
        $add->unionId = $request->unionId;
        $add->divisionId = $request->divisionId;
        $add->districtId = $request->districtId;
        $add->upazilaId = $request->upazilaId;
        $add->unionBng = $request->unionBng;
        $add->unionEng = $request->unionEng;
        $add->dataUpdateBy = $getId;
        $add->dataUpdateIp = $ipaddress;
        $add->save();
        if ($add) {
            flash('Successfully Added')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function deleteUnion($id)
    {
        Union::find($id)->delete();
        flash('Successfully Deleted')->success();
        return back();
    }
    // village
    public function villageList()
    { 
        $divisions = $this->division->getDivisionList();
        return view('admin.village.index')->with([
            'divisions' => $divisions,
        ]);
    }
    public function createVillage()
    { 
        $divisionList = $this->division->getDivisionList();
        return view('admin.village.create')->with([
            'divisionList' => $divisionList,
        ]);
    }

    public function storeVillage(Request $request)
    {   
        // return $request->all();
        $getId= Auth::user()->id;
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        $randnum = rand(1000,999999);
        $add = new Village();
        $add->villageId = $randnum;
        $add->unionId = $request->unionId;
        $add->divisionId = $request->divisionId;
        $add->districtId = $request->districtId;
        $add->upazilaId = $request->upazilaId;
        $add->municipalityId = '0'.'0';
        $add->villageBng = $request->villageBng;
        $add->villageEng = $request->villageEng;
        $add->dataCreateBy = $getId;
        $add->dataCreateIp = $ipaddress;
        $add->save();
        if ($add) {
            flash('Successfully Added')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function editVillage($id)
    { 
        $data = Village::findOrFail($id);
        $divisionList = $this->division->getDivisionList();
        $getDivision = $this->division->getDivision($data);
        $getDistrict = $this->district->getDistrictName($data);
        $getUpazila = $this->upazila->getUpazilaName($data);
        $getUnion = $this->union->getUnionName($data);
        return view('admin.village.edit')->with([
            'data' => $data,
            'divisionList' => $divisionList,
            'getDivision' => $getDivision,
            'getDistrict' => $getDistrict,
            'getUpazila' => $getUpazila,
            'getUnion' => $getUnion,
        ]);
    }
    public function updateVillage(Request $request)
    {   
        $getId= Auth::user()->id;
        // return $getId; 
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        $add = Village::find($request->id);
        $add->unionId = $request->unionId;
        $add->divisionId = $request->divisionId;
        $add->districtId = $request->districtId;
        $add->upazilaId = $request->upazilaId;
        $add->villageBng = $request->villageBng;
        $add->villageEng = $request->villageEng;
        $add->dataUpdateBy = $getId;
        $add->dataUpdateIp = $ipaddress;
        $add->save();
        if ($add) {
            flash('Successfully Added')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function deleteVillage($id)
    {
        Village::find($id)->delete();
        flash('Successfully Deleted')->success();
        return back();
    }
    // postOffice
    public function postOfficeList()
    { 
        $divisions = $this->division->getDivisionList();
        return view('admin.postoffice.index')->with([
            'divisions' => $divisions,
        ]);
    }
    public function createPostOffice()
    { 
        $divisionList = $this->division->getDivisionList();
        return view('admin.postoffice.create')->with([
            'divisionList' => $divisionList,
        ]);
    }

    public function storePostOffice(Request $request)
    {   
        // return $request->all();
        $getId= Auth::user()->id;
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        $randnum = rand(1000,999999);
        $add = new PostOffice();
        $add->postId = $randnum;
        $add->divisionId = $request->divisionId;
        $add->districtId = $request->districtId;
        $add->upazilaId = $request->upazilaId;
        $add->municipalityId = 0;
        $add->unionId = 0;
        $add->postOfficeBangla = $request->postOfficeBangla;
        $add->postOfficeEnglish = $request->postOfficeEnglish;
        $add->dataEntryBy = $getId;
        $add->dataEntryIp = $ipaddress;
        $add->save();
        if ($add) {
            flash('Successfully Added')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function editPostOffice($id)
    { 
        $data = PostOffice::findOrFail($id);
        $divisionList = $this->division->getDivisionList();
        $getDivision = $this->division->getDivision($data);
        $getDistrict = $this->district->getDistrictName($data);
        $getUpazila = $this->upazila->getUpazilaName($data);
        $getUnion = $this->union->getUnionName($data);
        return view('admin.postoffice.edit')->with([
            'data' => $data,
            'divisionList' => $divisionList,
            'getDivision' => $getDivision,
            'getDistrict' => $getDistrict,
            'getUpazila' => $getUpazila,
            'getUnion' => $getUnion,
        ]);
    }
    public function updatePostOffice(Request $request)
    {   
        $getId= Auth::user()->id;
        // return $getId; 
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        $add = PostOffice::find($request->id);
        $add->divisionId = $request->divisionId;
        $add->districtId = $request->districtId;
        $add->upazilaId = $request->upazilaId;
        $add->postOfficeBangla = $request->postOfficeBangla;
        $add->postOfficeEnglish = $request->postOfficeEnglish;
        $add->dataUpdateBy = $getId;
        $add->dataUpdateIp = $ipaddress;
        $add->save();
        if ($add) {
            flash('Successfully Added')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function deletePostOffice($id)
    {
        PostOffice::find($id)->delete();
        flash('Successfully Deleted')->success();
        return back();
    }
}
