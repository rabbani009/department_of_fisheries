<?php

namespace App\Http\Controllers\Fishers;

use App\Http\Controllers\Controller;
use App\Models\Fishers\Fishers;
use App\Repositories\Fishers\FishersInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class FishersController extends Controller
{
    private $fishers;
    public function __construct(FishersInterface $fishers)
    {
        $this->middleware('auth');
        $this->middleware('preventBackHistory'); 
        $this->fishers = $fishers;
    }

    public function fishersList()
    {
        $data = $this->fishers->getFishersList();
        $divisions = DB::table('divisions')->orderBy('name', 'ASC')->get();
        return view('admin.fishers.index')->with([
            'data' => $data,
            'divisions' => $divisions
        ]);
    }

    public function createFishers()
    {
        $divisions = DB::table('divisions')->orderBy('name', 'ASC')->get();
        $educationalQualifications = DB::table('educational_qualifications')->orderBy('educationalQualification', 'ASC')->get();
        $fishSalePlace = DB::table('fish_sale_places')->orderBy('id', 'ASC')->get();
        $placeOfFishing = DB::table('place_of_fishings')->orderBy('id', 'ASC')->get();
        $fishingTime = DB::table('fishing_times')->orderBy('id', 'ASC')->get();
        $yearlyLoans = DB::table('yearly_loans')->orderBy('id', 'ASC')->get();
        $yearlySavings = DB::table('yearly_savings')->orderBy('id', 'ASC')->get();
        $crisisPeriods = DB::table('crisis_periods')->orderBy('id', 'ASC')->get();
        $ownerOfVessels = DB::table('owner_of_vessels')->orderBy('id', 'ASC')->get();
        return view('admin.fishers.create')->with([
            'divisions' => $divisions,
            'educationalQualifications' => $educationalQualifications,
            'fishSalePlace' => $fishSalePlace,
            'placeOfFishing' => $placeOfFishing,
            'fishingTime' => $fishingTime,
            'yearlyLoans' => $yearlyLoans,
            'yearlySavings' => $yearlySavings,
            'crisisPeriods' => $crisisPeriods,
            'ownerOfVessels' => $ownerOfVessels,
        ]);
    }
    // public function createFishersTwo()
    // {
    //     $divisions = DB::table('divisions')->orderBy('name', 'ASC')->get();
    //     $educationalQualifications = DB::table('educational_qualifications')->orderBy('educationalQualification', 'ASC')->get();
    //     $fishSalePlace = DB::table('fish_sale_places')->orderBy('id', 'ASC')->get();
    //     $placeOfFishing = DB::table('place_of_fishings')->orderBy('id', 'ASC')->get();
    //     $fishingTime = DB::table('fishing_times')->orderBy('id', 'ASC')->get();
    //     $yearlyLoans = DB::table('yearly_loans')->orderBy('id', 'ASC')->get();
    //     $yearlySavings = DB::table('yearly_savings')->orderBy('id', 'ASC')->get();
    //     $crisisPeriods = DB::table('crisis_periods')->orderBy('id', 'ASC')->get();
    //     $ownerOfVessels = DB::table('owner_of_vessels')->orderBy('id', 'ASC')->get();
    //     return view('livewire.multi-step-form')->with([
    //         'divisions' => $divisions,
    //         'educationalQualifications' => $educationalQualifications,
    //         'fishSalePlace' => $fishSalePlace,
    //         'placeOfFishing' => $placeOfFishing,
    //         'fishingTime' => $fishingTime,
    //         'yearlyLoans' => $yearlyLoans,
    //         'yearlySavings' => $yearlySavings,
    //         'crisisPeriods' => $crisisPeriods,
    //         'ownerOfVessels' => $ownerOfVessels,
    //     ]);
    // }

    public function storeFishers(Request $request)
    {
        $request->validate([
            'fisherName' => 'required',
            'fatherName' => 'required',
            'motherName' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'physicallyHandicapped' => 'required',
            'maritalStatus' => 'required',
            'division' => 'required',
            'district' => 'required',
            'upazila' => 'required',
            'area' => 'required',
            'postOffice' => 'required',
            'address' => 'required',
            'fishingArea' => 'required',
            'fishingTime' => 'required',
            'typesOfFishing' => 'required',
            'placeOfFishing' => 'required',
            'fishSalePlace' => 'required',
            'yearlyLoan' => 'required',
            'yearlySavings' => 'required',
            'ownerOfVessels' => 'required',
            'dateOfBirthDay' => 'required',
            'dateOfBirthMonth' => 'required',
            'dateOfBirthYear' => 'required',
            'nid' => 'required',
            'educationalQualification' => 'required',
            'religion' => 'required',
            'crisisPeriod' => 'required',
        ]);
        $data = (object) $request->all();
        $add = $this->fishers->storeFishers($data);
        if ($add) {
            flash('Successfully Added')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function getFishersBasicInformation(){

        return view('admin.fishers.basic-information');
    }
    
    public function storeFishersBasicInformation(Request $request){
        $request->validate([
            'fisherName' => 'required',
            'fatherName' => 'required',
            'motherName' => 'required',
            'gender' => 'required',
            'physicallyHandicapped' => 'required',
            'maritalStatus' => 'required',
            'dateOfBirthDay' => 'required',
            'dateOfBirthMonth' => 'required',
            'dateOfBirthYear' => 'required',
            'religion' => 'required',
            'educationalQualification' => 'required',
        ]);
        $data = (object) $request->all();
        // session()->put('data', $data); 
       $add= $this->fishers->storeFisherBasicInformation($data);
        return $add;
        // $add = $this->fishers->storeFishers($data);
    //  return  $data;
    }
    public function storeFishersAddress(Request $request){
        $data = (object) $request->all();
        // session()->put('data', $data); 
       $add= $this->fishers->storeFisherAddress($data);
        return $add;
        //  $adata=session()->get('data'); 
        // $data = (object) $request->all();
        // // $f =$adata+$data;
        // $add = $this->fishers->storeFishers($data);
        // return $add;
        // return $sdata;
        // session()->put('data', $data); 
        // $add = $this->fishers->storeFishers($data);
    //  return  $data;
    }

    public function viewFishers($id)
    {
        $educationalQualifications = DB::table('educational_qualifications')->orderBy('educationalQualification', 'ASC')->get();
        $data = $this->fishers->getSingleFishersData($id);
        // return $data;
        return view('admin.fishers.view')->with([
            'data' => $data['singleData'],
            'divisionData' => $data['division'],
            'districtData' => $data['district'],
            'upazilaData' => $data['upazila'],
            'areaData' => $data['area'],
            'educationalQualifications' => $educationalQualifications,
            
        ]);
    }

    public function editFishers($id)
    {
        $data = $this->fishers->getSingleFishersData($id);
        $educationalQualifications = DB::table('educational_qualifications')->orderBy('educationalQualification', 'ASC')->get();
        $divisions = DB::table('divisions')->orderBy('name', 'ASC')->get();
        $alldistrictData = DB::table('districts')->orderBy('name', 'ASC')->get();
        $fishSalePlace = DB::table('fish_sale_places')->orderBy('id', 'ASC')->get();
        $placeOfFishing = DB::table('place_of_fishings')->orderBy('id', 'ASC')->get();
        $fishingTime = DB::table('fishing_times')->orderBy('id', 'ASC')->get();
        $yearlyLoans = DB::table('yearly_loans')->orderBy('id', 'ASC')->get();
        $yearlySavings = DB::table('yearly_savings')->orderBy('id', 'ASC')->get();
        $crisisPeriods = DB::table('crisis_periods')->orderBy('id', 'ASC')->get();
        $ownerOfVessels = DB::table('owner_of_vessels')->orderBy('id', 'ASC')->get();
        return view('admin.fishers.edit')->with([
            'data' => $data['singleData'],
            'divisions' => $divisions,
            'alldistrictData' => $alldistrictData,
            'educationalQualifications' => $educationalQualifications,
            'fishSalePlace' => $fishSalePlace,
            'placeOfFishing' => $placeOfFishing,
            'fishingTime' => $fishingTime,
            'yearlyLoans' => $yearlyLoans,
            'yearlySavings' => $yearlySavings,
            'crisisPeriods' => $crisisPeriods,
            'ownerOfVessels' => $ownerOfVessels,
        ]);
    }

    public function updateFishers(Request $request)
    {
        $request->validate([
            'fisherName' => 'required',
            'fatherName' => 'required',
            'motherName' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'physicallyHandicapped' => 'required',
            'maritalStatus' => 'required',
            'division' => 'required',
            'district' => 'required',
            'upazila' => 'required',
            'area' => 'required',
            'postOffice' => 'required',
            'address' => 'required',
            'fishingArea' => 'required',
            'fishingTime' => 'required',
            'typesOfFishing' => 'required',
            'placeOfFishing' => 'required',
            'fishSalePlace' => 'required',
            'yearlyLoan' => 'required',
            'yearlySavings' => 'required',
            'ownerOfVessels' => 'required',
            'dateOfBirthDay' => 'required',
            'dateOfBirthMonth' => 'required',
            'dateOfBirthYear' => 'required',
            'nid' => 'required',
            'educationalQualification' => 'required',
            'religion' => 'required',
            'crisisPeriod' => 'required',
        ]);
        $data = (object) $request->all();
        $add = $this->fishers->updateFishers($data->id, $data);
        if ($add) {
            flash('Successfully Updated')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }

    public function deleteFishersList($id)
    {
        Fishers::find($id)->delete();
        flash('Successfully Deleted')->success();
        return back();
    }


    public function getFishersReport(Request $request)
    {
        $data = (object) $request->all();
        $add = $this->fishers->getFishersReportData($data);
        $divisions = DB::table('divisions')->orderBy('name', 'ASC')->get();
        return view('admin.fishers.fishers-report')->with([
            'data' => $add,
            'divisions' => $divisions
        ]);
    }

    public function getDistrictWiseFishers()
    {   
        $dhakaDatainfo = array(
            'totalFishers' => 100,
            'totalPeople' => 200,
        );
        return view('admin.reports.districtMap',compact('dhakaDatainfo'));
    }

    public function getFishersInfo()
    {
        return view('admin.reports.fisherList');
    }

    public function getFishersAge(Request $request){
        $birthDay=$request->birthDay;
        $birthMonth=$request->birthMonth;
        $birthYear=$request->birthYear;
        $years =$birthYear."-".$birthMonth."-".$birthDay;
        // $age = Carbon::parse($years)->age;;
        $age = Carbon::parse($years)->diff(Carbon::now())->format('%y years, %m months and %d days');
        
        return response()->json([
            'age' => $age,
        ]);
    }

    // public function generatePdf()
    // {
    //     $data = [
    //         'title' => 'Welcome to ItSolutionStuff.com',
    //         'date' => date('m/d/Y')
    //     ];
    //     $pdf = PDF::loadView('myPDF', $data);
    //     return $pdf->download('itsolutionstuff.pdf');
    // }
}
