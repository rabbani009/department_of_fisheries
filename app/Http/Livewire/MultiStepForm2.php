<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\District;
use App\Models\Division;
use App\Models\Fishers\Fishers;
use App\Models\FishingTime\FishingTime;
use App\Models\Upazila;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MultiStepForm extends Component
{
    public $phone;
    public $nid;
    public $fisherName;
    public $fatherName;
    public $motherName;
    public $gender;
    public $physicallyHandicapped;
    public $maritalStatus;
    public $dateOfBirthDay;
    public $getdateOfBirthDay;
    public $dateOfBirthMonth;
    public $getdateOfBirthMonth;
    public $dateOfBirthYear;
    public $getdateOfBirthYear;
    public $educationalQualification;
    public $religion;
    public $spouseName;
    public $familyMember;
    public $numberOfChild;
    public $birthPlace;
    public $nationality;
    public $permanentAddress;
    public $presentAddress;
    // public $division;
    // public $district;
    // public $upazila;
    // public $area;
    public $postOffice;
    public $address;

    public $getdivisions;
    public $getdistricts;
    public $getupazila;
    public $getarea;
    public $division = NULL;
    public $district = NULL;
    public $upazila = NULL;
    public $area = NULL;
    public $fishingArea;
    public $fishingTime;
    public $typesOfFishing;
    public $placeOfFishing;
    public $fishSalePlace;
    public $yearlyLoan;
    public $yearlySavings;
    public $ownerOfVessels;
    public $crisisPeriod;
    // public $fishingTimeData;
    public $totalSteps = 4;
    public $currentStep = 1;
    public $dob;
    public $age;
    public function mount()
    {
        $this->getdivisions = Division::all();
        // $this->dateOfBirthDay=01;
        // $this->fishSalePlace = DB::table('fish_sale_places')->orderBy('id', 'ASC')->get();
        // $this->fishingTimeData = FishingTime::orderBy('id', 'ASC')->get();
        // dd( $this->getdivisions);
        // $this->getdistricts = collect();
    }
    public function stepCount()
    {
        $this->currentStep = 1;
    }
    public function render()
    {
        // $getdivisions = DB::table('divisions')->orderBy('name', 'ASC')->get();
        // $districtData = DB::table('districts')->orderBy('name', 'ASC')->get();
        $educationalQualifications = DB::table('educational_qualifications')->orderBy('educationalQualification', 'ASC')->get();
        // $fishSalePlaceData = DB::table('fish_sale_places')->orderBy('id', 'ASC')->get();
        // $placeOfFishingData = DB::table('place_of_fishings')->orderBy('id', 'ASC')->get();
        // $fishingTimeData = DB::table('fishing_times')->orderBy('id', 'ASC')->get();
        // $yearlyLoans = DB::table('yearly_loans')->orderBy('id', 'ASC')->get();
        // $yearlySavings = DB::table('yearly_savings')->orderBy('id', 'ASC')->get();
        // $crisisPeriods = DB::table('crisis_periods')->orderBy('id', 'ASC')->get();
        // $ownerOfVessels = DB::table('owner_of_vessels')->orderBy('id', 'ASC')->get();
        return view('livewire.multi-step-form')->with([
            // 'getdivisions' => $getdivisions,
            // 'districtData' => $districtData,
            'educationalQualifications' => $educationalQualifications,
            // 'fishSalePlaceData' => $fishSalePlaceData,
            // 'placeOfFishingData' => $placeOfFishingData,
            // 'fishingTimeData' => $fishingTimeData,
            // 'yearlyLoansData' => $yearlyLoans,
            // 'yearlySavingsData' => $yearlySavings,
            // 'crisisPeriodsData' => $crisisPeriods,
            // 'ownerOfVesselsData' => $ownerOfVessels,
        ]);
    }

    public function increaseStep()
    {
        $this->resetErrorBag();
        $this->validateData();
        $this->currentStep++;
        if ($this->currentStep > $this->totalSteps) {
            $this->currentStep = $this->totalSteps;
        }
    }

    public function decreaseStep()
    {
        $this->resetErrorBag();
        $this->currentStep--;
        if ($this->currentStep < 1) {
            $this->currentStep = 1;
        }
    }


    public function validateData()
    {
        if ($this->currentStep == 1) {
            $this->validate([
                'phone' => 'required|unique:fishers',
                // 'nid' => 'required|unique:fishers',
            ]);
        } elseif ($this->currentStep == 2) {
            $this->validate([
                'fisherName' => 'required',
                // 'fatherName' => 'required',
                // 'motherName' => 'required',
                // 'gender' => 'required',
                // 'physicallyHandicapped' => 'required',
                // 'maritalStatus' => 'required',
                // 'dateOfBirthDay' => 'required',
                // 'dateOfBirthMonth' => 'required',
                // 'dateOfBirthYear' => 'required',
                // 'educationalQualification' => 'required',
                // 'religion' => 'required',
                // 'spouseName' => 'required',
                // 'familyMember' => 'required',
                // 'numberOfChild' => 'required',
                // // // 'nationality' => 'required',
                // 'birthPlace' => 'required',
            ]);
        } elseif ($this->currentStep = 3) {
            $this->validate([
                'division' => 'required',
                // 'district' => 'required',
                // 'upazila' => 'required',
                // 'area' => 'required',
                // 'postOffice' => 'required',
                // 'address' => 'required',
                // 'permanentAddress' => 'required',
                // 'presentAddress' => 'required',
            ]);
        }
    }
    public function storeFishersData()
    {
        $this->resetErrorBag();
        if ($this->currentStep = 4) {
            $this->validate([
                'fishingArea' => 'required',
                // 'fishingTime' => 'required',
                // 'typesOfFishing' => 'required',
                // 'placeOfFishing' => 'required',
                // 'fishSalePlace' => 'required',
                // 'yearlyLoan' => 'required',
                // 'yearlySavings' => 'required',
                // 'ownerOfVessels' => 'required',
                // 'crisisPeriod' => 'required',
            ]);
        }
        // dd("wjesp");
        $number = mt_rand(100000, 999999);
        $date = Carbon::now();
        $values = array(
            "phone" => $this->phone,
            "nid" => $this->nid,
            "fisherName" => $this->fisherName,
            "fatherName" => $this->fatherName,
            "motherName" => $this->motherName,
            "gender" => $this->gender,
            "physicallyHandicapped" => $this->physicallyHandicapped,
            "maritalStatus" => $this->maritalStatus,
            "dateOfBirthDay" => $this->dateOfBirthDay,
            "dateOfBirthMonth" => $this->dateOfBirthMonth,
            "dateOfBirthYear" => $this->dateOfBirthYear,
            "educationalQualification" => $this->educationalQualification,
            "religion" => $this->religion,
            "spouseName" => $this->spouseName,
            "familyMember" => $this->familyMember,
            "numberOfChild" => $this->numberOfChild,
            "nationality" => $this->nationality,
            "birthPlace" => $this->birthPlace,
            "division" => $this->division,
            "district" => $this->district,
            "upazila" => $this->upazila,
            "area" => $this->area,
            "postOffice" => $this->postOffice,
            "address" => $this->address,
            "permanentAddress" => $this->permanentAddress,
            "presentAddress" => $this->presentAddress,
            "fishingArea" => $this->fishingArea,
            "fishingTime" => $this->fishingTime,
            "typesOfFishing" => $this->typesOfFishing,
            "placeOfFishing" => $this->placeOfFishing,
            "fishSalePlace" => $this->fishSalePlace,
            "yearlyLoan" => $this->yearlyLoan,
            "yearlySavings" => $this->yearlySavings,
            "ownerOfVessels" => $this->ownerOfVessels,
            "crisisPeriod" => $this->crisisPeriod,
            "dob" => $this->dob,
            "age" => $this->age,
            "status" => Config::get('constants.Active'),
            "registrationNo" => $number,
            "rfIdNumber" => $number,
            "created_at" => $date,
        );
        Fishers::insert($values);
        $this->reset();
        $this->currentStep = 1;
        session()->flash('message', 'Successfully Added.');
    }

    public function updatedDivision($divisionList)
    {
        if (!is_null($divisionList)) {
            $this->getdistricts = District::where('division_id', $divisionList)->get();
        }
    }
    public function updatedDistrict($districtList)
    {
        if (!is_null($districtList)) {
            $this->getupazila = Upazila::where('district_id', $districtList)->get();
        }
    }
    public function updatedUpazila($getupazilaList)
    {
        if (!is_null($getupazilaList)) {
            $this->getarea = Area::where('upazilla_id', $getupazilaList)->get();
        }
    }

    public function updatedDateOfBirthDay($dateOfBirthDay)
    {
        // dd($dateOfBirthDay);
        $this->getdateOfBirthDay = $dateOfBirthDay;
        if(!empty( $this->getdateOfBirthMonth)&& !empty( $this->getdateOfBirthYear)){
            
            $this->dob = $this->getdateOfBirthYear . "-" . $this->getdateOfBirthMonth . "-" . $this->getdateOfBirthDay;
        }
        else{
            $this->dob = 0000 . "-" . 00 . "-" . $this->getdateOfBirthDay;

        }
        $years = Carbon::parse($this->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
        $this->age = $years;
    }
    public function updatedDateOfBirthMonth($dateOfBirthMonth)
    {
        // dd($dateOfBirthMonth);
        $this->getdateOfBirthMonth = $dateOfBirthMonth;
        if(!empty( $this->getdateOfBirthDay)&& !empty( $this->getdateOfBirthYear)){
            
            $this->dob = $this->getdateOfBirthYear . "-" . $this->getdateOfBirthMonth . "-" . $this->getdateOfBirthDay;
        }
        else{
            $this->dob = 0000 . "-" . $this->getdateOfBirthMonth . "-" . 00;

        }
        $years = Carbon::parse($this->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
        $this->age = $years;
        
    }
    public function updatedDateOfBirthYear($dateOfBirthYear)
    {
        $this->getdateOfBirthYear = $dateOfBirthYear;
        $this->dob = $this->getdateOfBirthYear . "-" . $this->getdateOfBirthMonth . "-" . $this->getdateOfBirthDay;
        $years = Carbon::parse($this->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
        $this->age = $years;
    }
    // public function updateAge(){
    //     $this->dob = $this->getdateOfBirthYear . "-" . $this->getdateOfBirthMonth . "-" . $this->getdateOfBirthDay;
    //     $years = Carbon::parse($this->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
    //     $this->age = $years;
    // }
}
