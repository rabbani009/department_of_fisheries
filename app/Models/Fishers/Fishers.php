<?php

namespace App\Models\Fishers;

use App\Models\Area;
use App\Models\CrisisPeriod\CrisisPeriod;
use App\Models\District;
use App\Models\Division;
use App\Models\EducationalQualifications\EducationalQualifications;
use App\Models\FishingTime\FishingTime;
use App\Models\FishSalePlace\FishSalePlace;
use App\Models\OwnerOfVessels\OwnerOfVessels;
use App\Models\PlaceOfFishing\PlaceOfFishing;
use App\Models\Upazila;
use App\Models\YearlyLoan\YearlyLoan;
use App\Models\YearlySavings\YearlySavings;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Fishers extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'fishers';

    protected $fillable = [
        'fisherName',
        'userType',
        'status',
        'fatherName',
        'motherName',
        'phone',
        'dateOfBirthDay',
        'dateOfBirthMonth',
        'dateOfBirthYear',
        'dof',
        'nid',
        'gender',
        'physicallyHandicapped',
        'maritalStatus',
        'division',
        'district',
        'upazila',
        'area',
        'postOffice',
        'address',
        'fishingArea',
        'fishingStartTime',
        'fishingEndTime',
        'image',
        'allowance',
        'type',
        'registrationNo',
        'rfIdNumber',
        'educationalQualification',
    ];
    public function getFishersList()
    {
        return static::orderBy('id', 'ASC')->paginate(30);
    }
    public function educational_qualifications()
    {
        return $this->belongsTo(EducationalQualifications::class,'educationalQualification');
    }
    public function fish_sale_place()
    {
        return $this->belongsTo(FishSalePlace::class,'fishSalePlace');
    }
    public function place_of_fishing()
    {
        return $this->belongsTo(PlaceOfFishing::class,'placeOfFishing');
    }
    public function fishing_time()
    {
        return $this->belongsTo(FishingTime::class,'fishingTime');
    }
    public function yearly_loan()
    {
        return $this->belongsTo(YearlyLoan::class,'yearlyLoan');
    }
    public function yearly_savings()
    {
        return $this->belongsTo(YearlySavings::class,'yearlySavings');
    }
    public function crisis_period()
    {
        return $this->belongsTo(CrisisPeriod::class,'crisisPeriod');
    }
    public function owner_of_vessels()
    {
        return $this->belongsTo(OwnerOfVessels::class,'ownerOfVessels');
    }
    public function division_data()
    {
        return $this->belongsTo(Division::class,'division');
    }
    public function district_data()
    {
        return $this->belongsTo(District::class,'district');
    }
    public function birthPlace_data()
    {
        return $this->belongsTo(District::class,'birthPlace');
    }
    public function upazila_data()
    {
        return $this->belongsTo(Upazila::class,'upazila');
    }
    public function area_data()
    {
        return $this->belongsTo(Area::class,'area');
    }

    public function storeFishers($data)
    {
        // return $data;
        $number = mt_rand(100000, 999999);
        $day = $data->dateOfBirthDay;
        $month = $data->dateOfBirthMonth;
        $year = $data->dateOfBirthYear;
        $add = new static();
        $add->fisherName = $data->fisherName;
        // $add->userType = $data->userType;
        $add->status = Config::get('constants.Active');
        $add->fatherName = $data->fatherName;
        $add->motherName = $data->motherName;
        $add->phone = $data->phone;
        $add->dateOfBirthDay = $data->dateOfBirthDay;
        $add->dateOfBirthMonth = $data->dateOfBirthMonth;
        $add->dateOfBirthYear = $data->dateOfBirthYear;
        $add->dof = $year . "-" . $month . "-" . $day;
        $add->nid = $data->nid;
        $add->gender = $data->gender;
        $add->physicallyHandicapped = $data->physicallyHandicapped;
        $add->maritalStatus = $data->maritalStatus;
        $add->division = $data->division;
        $add->district = $data->district;
        $add->upazila = $data->upazila;
        $add->area = $data->area;
        $add->postOffice = $data->postOffice;
        $add->address = $data->address;
        $add->fishingArea = $data->fishingArea;
        $add->fishingTime = $data->fishingTime;
        $add->typesOfFishing = $data->typesOfFishing;
        $add->placeOfFishing = $data->placeOfFishing;
        $add->fishSalePlace = $data->fishSalePlace;
        $add->yearlyLoan = $data->yearlyLoan;
        $add->yearlySavings = $data->yearlySavings;
        $add->crisisPeriod = $data->crisisPeriod;
        $add->ownerOfVessels = $data->ownerOfVessels;
        // $add->fishingStartTime = $data->fishingStartTime;
        // $add->fishingEndTime = $data->fishingEndTime;
        // $add->allowance = $data->allowance;
        // $add->type = $data->type;
        $add->registrationNo = $number;
        $add->rfIdNumber = $number;
        $add->educationalQualification = $data->educationalQualification;
        $add->religion = $data->religion;
        if ($add->save()) {
            return $add;
        }
        return false;
    }
    
    public function updateFishers($id, $data)
    {
        // return $data;
        $number = mt_rand(100000, 999999);
        $day = $data->dateOfBirthDay;
        $month = $data->dateOfBirthMonth;
        $year = $data->dateOfBirthYear;
        $add = static::find($id);
        $add->fisherName = $data->fisherName;
        // $add->userType = $data->userType;
        $add->status = Config::get('constants.Active');
        $add->fatherName = $data->fatherName;
        $add->motherName = $data->motherName;
        $add->phone = $data->phone;
        $add->dateOfBirthDay = $data->dateOfBirthDay;
        $add->dateOfBirthMonth = $data->dateOfBirthMonth;
        $add->dateOfBirthYear = $data->dateOfBirthYear;
        $add->dob = $year . "-" . $month . "-" . $day;
        $add->nid = $data->nid;
        $add->gender = $data->gender;
        $add->physicallyHandicapped = $data->physicallyHandicapped;
        $add->maritalStatus = $data->maritalStatus;
        $add->division = $data->division;
        $add->district = $data->district;
        $add->upazila = $data->upazila;
        $add->area = $data->area;
        $add->postOffice = $data->postOffice;
        $add->address = $data->address;
        $add->fishingArea = $data->fishingArea;
        $add->fishingTime = $data->fishingTime;
        $add->typesOfFishing = $data->typesOfFishing;
        $add->placeOfFishing = $data->placeOfFishing;
        $add->fishSalePlace = $data->fishSalePlace;
        $add->yearlyLoan = $data->yearlyLoan;
        $add->yearlySavings = $data->yearlySavings;
        $add->crisisPeriod = $data->crisisPeriod;
        $add->ownerOfVessels = $data->ownerOfVessels;
        $add->age = $data->age;
        // $add->fishingStartTime = date("H:i:s", strtotime($data->fishingStartTime));
        // $add->fishingEndTime = $data->fishingEndTime;
        // $add->allowance = $data->allowance;
        // $add->type = $data->type;
        $add->registrationNo = $number;
        $add->rfIdNumber = $number;
        $add->educationalQualification = $data->educationalQualification;
        $add->religion = $data->religion;
        $add->spouseName = $data->spouseName;
        $add->familyMember = $data->familyMember;
        $add->numberOfChild = $data->numberOfChild;
        $add->birthPlace = $data->birthPlace;
        if ($add->save()) {
            return $add;
        }
        return false;
    }

    public function getSingleFishersData($id)
    {
        $singleData=static::with('birthPlace_data','upazila_data','area_data','division_data','district_data','educational_qualifications','owner_of_vessels','crisis_period','yearly_savings','yearly_loan','fish_sale_place','place_of_fishing','fishing_time')
        ->where('id', $id)
        ->first();
        return [
            'singleData'=>$singleData,
        ];
    }

    public function getFishersReportData($data)
    {
        if(($data->divisionId!=null)&&($data->districtId!=null)&&($data->upazilaId!=null)&&($data->areaId!=null)){

            return static::where('division',$data->divisionId)
            ->where('district',$data->districtId)
            ->where('upazila',$data->upazilaId)
            ->where('area',$data->areaId)
            ->get();
        }
        else{
            return static::where('division',0)
            ->where('district',0)
            ->where('upazila',0)
            ->where('area',0)
            ->get();
        }
        // return $data->division;
    }
    //search oat the report page.
    public function scopeSearch($query,$search)
    {
        return $query->where('fisherName', 'like', '%'.$search.'%')
        ->orWhere('nid', 'like', '%'.$search.'%')
        ->orWhere('phone', 'like', '%'.$search.'%');
    }

    public function scopeGetfisherdatabydate($query,$startDate,$endDate)
    {
        return $query->whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate);
    }

    public static function getfisherdata($startDate,$endDate)
    {
        $data=static::whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)->get();
        return $data;
    }

    public static function getFisherforExcelList($startDate,$endDate)
    {
        $data=static::select('fisherName','phone','dob')->whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)->get()->toArray();
        return $data;
    }

}
