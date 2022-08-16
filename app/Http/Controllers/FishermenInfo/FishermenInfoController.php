<?php

namespace App\Http\Controllers\FishermenInfo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FishermenInfoCardPrint;
use App\Repositories\FishermenInfoCardPrint\FishermenInfoCardPrintInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DataTables;
use PDF;
use App\Exports\FisherDateExport;
use App\Models\DeficiencyPeriod;
use App\Models\District;
use App\Models\Division;
use App\Models\Education;
use App\Models\FishCategory;
use App\Models\FishingEquipment;
use App\Models\FishingPlace;
use App\Models\FishSalePlaces;
use App\Models\GroupMember;
use App\Models\HowToFishing;
use App\Models\MaritalStatus;
use App\Models\Municipality;
use App\Models\OwnerOfNet;
use App\Models\OwnerOfVessels;
use App\Models\PostOffice;
use App\Models\Religion;
use App\Models\TimeOfFishing;
use App\Models\TypeOfEmploymentStatusInVessels;
use App\Models\TypeOfVessels;
use App\Models\Union;
use App\Models\Upazila;
use App\Models\Village;
use App\Models\YearlyLoan;
use App\Models\YearlySaving;
use App\Repositories\FishermenInfoStatsInfo\FishermenInfoStatsInfoInterface;
use Excel;
use Session;
use Image;
use Illuminate\Support\Facades\Auth;

class FishermenInfoController extends Controller
{
    private $fishers,
        $religion,
        $maritalStatus,
        $district,
        $division,
        $fishermenStats,
        $timeOfFishings,
        $placeOfFishings,
        $fishCategory,
        $fishingEquipment,
        $howToFishing,
        $groupMember,
        $typeOfVessels,
        $ownerOfVessels,
        $ownerOfNet,
        $typeOfEmploymentStatusinVessels,
        $fishSalePlaces,
        $yearlyLoan,
        $yearlySaving,
        $deficiencyPeriod,
        $upazila,
        $village,
        $municipality,
        $postOffice,
        $union,
        $education;
    public function __construct(
        FishermenInfoCardPrintInterface $fishers,
        Religion $religion,
        MaritalStatus $maritalStatus,
        Education $education,
        District $district,
        FishermenInfoStatsInfoInterface $fishermenStats,
        TimeOfFishing $timeOfFishings,
        FishingPlace $placeOfFishings,
        FishCategory $fishCategory,
        FishingEquipment $fishingEquipment,
        HowToFishing $howToFishing,
        GroupMember $groupMember,
        OwnerOfNet $ownerOfNet,
        TypeOfVessels $typeOfVessels,
        OwnerOfVessels $ownerOfVessels,
        TypeOfEmploymentStatusInVessels $typeOfEmploymentStatusinVessels,
        FishSalePlaces $fishSalePlaces,
        YearlyLoan $yearlyLoan,
        YearlySaving $yearlySaving,
        DeficiencyPeriod $deficiencyPeriod,
        Upazila $upazila,
        Municipality $municipality,
        Village $village,
        PostOffice $postOffice,
        Union $union,
        Division $division
    ) {
        $this->middleware('auth');
        $this->middleware('preventBackHistory'); 
        $this->fishermenInfoCardPrint = $fishers;
        $this->fishermenStats = $fishermenStats;
        $this->religion = $religion;
        $this->maritalStatus = $maritalStatus;
        $this->education = $education;
        $this->district = $district;
        $this->timeOfFishings = $timeOfFishings;
        $this->placeOfFishings = $placeOfFishings;
        $this->fishCategory = $fishCategory;
        $this->fishingEquipment = $fishingEquipment;
        $this->howToFishing = $howToFishing;
        $this->groupMember = $groupMember;
        $this->ownerOfNet = $ownerOfNet;
        $this->typeOfVessels = $typeOfVessels;
        $this->ownerOfVessels = $ownerOfVessels;
        $this->typeOfEmploymentStatusinVessels = $typeOfEmploymentStatusinVessels;
        $this->fishSalePlaces = $fishSalePlaces;
        $this->yearlyLoan = $yearlyLoan;
        $this->yearlySaving = $yearlySaving;
        $this->deficiencyPeriod = $deficiencyPeriod;
        $this->upazila = $upazila;
        $this->postOffice = $postOffice;
        $this->village = $village;
        $this->union = $union;
        $this->municipality = $municipality;
        $this->division = $division;
    }

    //personal information
    public function createFishermenPersonalInformation(Request $request)
    {
        // Session::flush();
        $sessionData = $request->session()->get('Fishermen_Personal_Information');
        // return $sessionData;
        $personalInfoSessionData = [
            'stats_mobile' => $request->session()->get('stats_mobile'),
            'stats_religion' => $request->session()->get('stats_religion'),
            'stats_placeOfBirth' => $request->session()->get('stats_placeOfBirth'),
            'stats_education' => $request->session()->get('stats_education'),
            'stats_identificationMark' => $request->session()->get('stats_identificationMark'),
        ];
      
        // return $personalInfoSessionData['stats_mobile'];
        $religionList = $this->religion->getReligionList();
        $educationList = $this->education->getEducationList();
        $districtList = $this->district->getDistrictList();
        return view('admin.fishermen-info-card-print.create-personal-info')->with([
            'sessionData' => $sessionData,
            'personalInfoSessionData' =>  $personalInfoSessionData,
            'religionList' => $religionList,
            'educationList' => $educationList,
            'districtList' => $districtList,
        ]);
    }
    public function storeFishermenPersonalInformation(Request $request)
    {
        if ($request->hasFile('photoPath')) {
            $file=$request->file('photoPath');
            $image_name=str_replace(' ', '_', substr($request->fishermanNameEng, 0, 5)) . '-'. uniqid() . '.'. $file->getClientOriginalExtension();
            $image=Image::make($file);

            $image->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                }

            );

            $img_canvas=Image::canvas(500, 500);
            $img_canvas->insert($image, 'center');
            $img_canvas->save(base_path('public/uploads/'. $image_name));
            $imagePath=$image_name;
        }
        $request->validate([
            'fishermanNameBng' => 'required',
            'fishermanNameEng' => 'required',
            'formId' => 'required',
            'nationalIdNo' => 'required|unique:fishermen_info_card_prints',
            // 'mobile' => 'required|unique:fishermen_info_stats_infos',
            'gender' => 'required',
            'religion' => 'required',
            'placeOfBirth' => 'required',
            'dateOfBirthDay' => 'required',
            'dateOfBirthMonth' => 'required',
            'dateOfBirthYear' => 'required',
            'education' => 'required',
        ]);
        $data = (object) $request->all();
        $add = $this->fishermenInfoCardPrint->storeFishermenPersonalInformation($data,$imagePath);
        if ($add) {
            $request->session()->put('Fishermen_Personal_Information', $add['storeFishermenPersonalInformation']);
            $request->session()->put('stats_mobile', $add['stats_mobile']);
            $request->session()->put('stats_religion', $add['stats_religion']);
            $request->session()->put('stats_placeOfBirth', $add['stats_placeOfBirth']);
            $request->session()->put('stats_education', $add['stats_education']);
            $request->session()->put('stats_identificationMark', $add['stats_identificationMark']);
            flash('Personal Information Added Successfully')->success();
            return redirect()->route('createFishermenFamilyInformation');
        } else {
            flash('Error')->error();
            return back();
        }
    }
    // family information
    public function createFishermenFamilyInformation(Request $request)
    {
        $fishermenFamilyInfoCard = $request->session()->get('Fishermen_Family_Information');
        // return $fishermenFamilyInfoCard;
        $familyInfoSessionData = [
            'stats_maritalStatus' => $request->session()->get('stats_maritalStatus'),
            'stats_totalFamilyMember' => $request->session()->get('stats_totalFamilyMember'),
            'stats_numberOfSpouse' => $request->session()->get('stats_numberOfSpouse'),
            'stats_numberOfMother' => $request->session()->get('stats_numberOfMother'),
            'stats_numberOfFather' => $request->session()->get('stats_numberOfFather'),
            'stats_numberOfDaughter' => $request->session()->get('stats_numberOfDaughter'),
            'stats_numberOfSon' => $request->session()->get('stats_numberOfSon'),
            'stats_numberOfOtherMember' => $request->session()->get('stats_numberOfOtherMember'),
        ];
        $maritalStatusList = $this->maritalStatus->getMaritalStatusList();
        return view('admin.fishermen-info-card-print.create-family-info')->with([
            'maritalStatusList' => $maritalStatusList,
            'fishermenFamilyInfoCard' =>  $fishermenFamilyInfoCard,
            'familyInfoSessionData' =>  $familyInfoSessionData,
        ]);
    }
    public function storeFishermenFamilyInformation(Request $request)
    {
        $request->validate([
            'mothersName' => 'required',
            'fathersName' => 'required',
            'maritalStatus' => 'required',
            'totalFamilyMember' => 'required',
        ]);
        $data = (object) $request->all();
        $add = $this->fishermenInfoCardPrint->storeFishermenFamilyInformation($data);
        // return $add;
        if ($add) {
            $request->session()->put('Fishermen_Family_Information', $add['storeFishermenFamilyInformation']);
            $request->session()->put('stats_maritalStatus', $add['stats_maritalStatus']);
            $request->session()->put('stats_totalFamilyMember', $add['stats_totalFamilyMember']);
            $request->session()->put('stats_numberOfSpouse', $add['stats_numberOfSpouse']);
            $request->session()->put('stats_numberOfMother', $add['stats_numberOfMother']);
            $request->session()->put('stats_numberOfFather', $add['stats_numberOfFather']);
            $request->session()->put('stats_numberOfDaughter', $add['stats_numberOfDaughter']);
            $request->session()->put('stats_numberOfSon', $add['stats_numberOfSon']);
            $request->session()->put('stats_numberOfOtherMember', $add['stats_numberOfOtherMember']);
            flash('Personal Information Added Successfully')->success();
            return redirect()->route('createFishermenAddressInformation');
        } else {
            flash('Error')->error();
            return back();
        }
    }
    // adrees information
    public function createFishermenAddressInformation(Request $request)
    {
        $divisionList = $this->division->getDivisionList();
        return view('admin.fishermen-info-card-print.create-address-info')->with([
            'divisionList' =>  $divisionList,
            'permanentdivisionList' =>  $divisionList,
        ]);
    }
    public function storeFishermenAddressInformation(Request $request)
    {
        // return $request->all();
        // $userId = Auth::user()->id;
        $request->validate([
            'divisionId' => 'required',
            'districtId' => 'required',
            'upazilaId' => 'required',
            'postOfficeId' => 'required',
            'presentDivisionId' => 'required',
            'presentDistrictId' => 'required',
            'presentUpazilaId' => 'required',
            'presentPostOfficeId' => 'required',
        ]);
        $data = (object) $request->all();
        $add = $this->fishermenInfoCardPrint->storeFishermenAddressInformation($data);
        if ($add) {
            $request->session()->put('Fishermen_Address_Information', $add['storeFishermenAddressInformation']);
            $request->session()->put('stats_presentDivisionId', $add['stats_presentDivisionId']);
            $request->session()->put('stats_presentDistrictId', $add['stats_presentDistrictId']);
            $request->session()->put('stats_presentUpazilaId', $add['stats_presentUpazilaId']);
            $request->session()->put('stats_presentMunicipalityId', $add['stats_presentMunicipalityId']);
            $request->session()->put('stats_presentWardId', $add['stats_presentWardId']);
            $request->session()->put('stats_presentUnionId', $add['stats_presentUnionId']);
            $request->session()->put('stats_presentVillageId', $add['stats_presentVillageId']);
            $request->session()->put('stats_presentPostOfficeId', $add['stats_presentPostOfficeId']);
            flash('Address Information Added Successfully')->success();
            return redirect()->route('createFishermenFishingInformation');
        } else {
            flash('Error')->error();
            return back();
        }
    }

    public function createFishermenFishingInformation(Request $request)
    {
        $timeOfFishingList = $this->timeOfFishings->getTimeOfFishings();
        $placeOfFishingList = $this->placeOfFishings->getFishingPlace();
        $fishCategoryList = $this->fishCategory->getFishCategory();
        $fishingEquipmentList = $this->fishingEquipment->getFishingEquipment();
        $howToFishingList = $this->howToFishing->getHowToFishing();
        $groupMemberList = $this->groupMember->getGroupMember();
        $groupMemberList = $this->groupMember->getGroupMember();
        $ownerOfNetList = $this->ownerOfNet->getOwnerOfNet();
        $typeOfVesselsList = $this->typeOfVessels->getTypeOfVessels();
        $ownerOfVesselsList = $this->ownerOfVessels->getOwnerOfVessels();
        $typeOfEmploymentStatusinVesselsList = $this->typeOfEmploymentStatusinVessels->getTypeOfEmploymentStatusinVessels();
        $fishSalePlacesList = $this->fishSalePlaces->getFishSalePlaces();
        $yearlyLoanList = $this->yearlyLoan->getYearlyLoan();
        $yearlySavingList = $this->yearlySaving->getYearlySaving();
        $deficiencyPeriodList = $this->deficiencyPeriod->getDeficiencyPeriod();
        return view('admin.fishermen-info-card-print.create-fishing-info')->with([
            'timeOfFishingList' =>  $timeOfFishingList,
            'placeOfFishingList' =>  $placeOfFishingList,
            'fishCategoryList' =>  $fishCategoryList,
            'fishingEquipmentList' =>  $fishingEquipmentList,
            'howToFishingList' =>  $howToFishingList,
            'groupMemberList' =>  $groupMemberList,
            'ownerOfNetList' =>  $ownerOfNetList,
            'typeOfVesselsList' =>  $typeOfVesselsList,
            'ownerOfVesselsList' =>  $ownerOfVesselsList,
            'typeOfEmploymentStatusinVesselsList' =>  $typeOfEmploymentStatusinVesselsList,
            'fishSalePlacesList' =>  $fishSalePlacesList,
            'yearlyLoanList' =>  $yearlyLoanList,
            'yearlySavingList' =>  $yearlySavingList,
            'deficiencyPeriodList' =>  $deficiencyPeriodList,
        ]);
    }
    public function storeFishermenFishingInformation(Request $request)
    {
        $userId = Auth::user()->id;
        $request->validate([
            'timeOfFishing' => 'required',
            'placeOfFishing' => 'required|array',
            'placeOfFishing.*' => 'required',
            'typeOfFish' => 'required|array',
            'typeOfFish.*' => 'required',
            'toolsType' => 'required|array',
            'toolsType.*' => 'required',
            'howToFishing' => 'required',
            'salePlaceOfFish' => 'required|array',
            'salePlaceOfFish.*' => 'required',
            'ownerOfNet' => 'required',
            'typeOfVessels' => 'required',
            'ownerOfVessels' => 'required',
            'typeOfEmploymentInVessels' => 'required',
            'yearlyLoan' => 'required',
            'yearlySaving' => 'required',
            'dangerPeriodOfLiving' => 'required',
        ]);
        $data = (object) $request->all();
        $fishermenPersonalInfoCard = $request->session()->get('Fishermen_Personal_Information');
        $fishermenFamilyInfoCard = $request->session()->get('Fishermen_Family_Information');
        $fishermenAddressInfoCard = $request->session()->get('Fishermen_Address_Information');
        // $fisherInfoCardId=$request->session()->get('fisherInfoCardId');
        $personalInfoSessionData = [
            'stats_mobile' => $request->session()->get('stats_mobile'),
            'stats_religion' => $request->session()->get('stats_religion'),
            'stats_placeOfBirth' => $request->session()->get('stats_placeOfBirth'),
            'stats_education' => $request->session()->get('stats_education'),
            'stats_identificationMark' => $request->session()->get('stats_identificationMark'),
        ];
        $familyInfoSessionData = [
            'stats_maritalStatus' => $request->session()->get('stats_maritalStatus'),
            'stats_totalFamilyMember' => $request->session()->get('stats_totalFamilyMember'),
            'stats_numberOfSpouse' => $request->session()->get('stats_numberOfSpouse'),
            'stats_numberOfMother' => $request->session()->get('stats_numberOfMother'),
            'stats_numberOfFather' => $request->session()->get('stats_numberOfFather'),
            'stats_numberOfDaughter' => $request->session()->get('stats_numberOfDaughter'),
            'stats_numberOfSon' => $request->session()->get('stats_numberOfSon'),
            'stats_numberOfOtherMember' => $request->session()->get('stats_numberOfOtherMember'),
        ];
        $addressSessionData = [
            'presentDivisionId' => $request->session()->get('stats_presentDivisionId'),
            'presentDistrictId' => $request->session()->get('stats_presentDistrictId'),
            'presentUpazilaId' => $request->session()->get('stats_presentUpazilaId'),
            'presentMunicipalityId' => $request->session()->get('stats_presentMunicipalityId'),
            'presentWardId' => $request->session()->get('stats_presentWardId'),
            'presentUnionId' => $request->session()->get('stats_presentUnionId'),
            'presentVillageId' => $request->session()->get('stats_presentVillageId'),
            'presentPostOfficeId' => $request->session()->get('stats_presentPostOfficeId'),
        ];
        $add = $this->fishermenInfoCardPrint->storeFishermenAllCardInformation($userId, $fishermenAddressInfoCard, $fishermenPersonalInfoCard, $fishermenFamilyInfoCard);
        if ($add) {
            if ($add['storeFishermenAllCardInformation']->id) {
                $fisherInfoCardId = $add['storeFishermenAllCardInformation']->id;
                $addStats = $this->fishermenStats->storeFishermenFishingInformation($data, $fisherInfoCardId, $personalInfoSessionData, $familyInfoSessionData, $addressSessionData);
                if ($addStats) {
                    $request->session()->forget('Fishermen_Personal_Information');
                    $request->session()->forget('Fishermen_Family_Information');
                    $request->session()->forget('Fishermen_Address_Information');
                    // personalInfoSessionData
                    $request->session()->forget('stats_mobile');
                    $request->session()->forget('stats_religion');
                    $request->session()->forget('stats_placeOfBirth');
                    $request->session()->forget('stats_education');
                    $request->session()->forget('stats_identificationMark');
                    // familyInfoSessionData
                    $request->session()->forget('stats_maritalStatus');
                    $request->session()->forget('stats_totalFamilyMember');
                    $request->session()->forget('stats_numberOfSpouse');
                    $request->session()->forget('stats_numberOfMother');
                    $request->session()->forget('stats_numberOfFather');
                    $request->session()->forget('stats_numberOfDaughter');
                    $request->session()->forget('stats_numberOfSon');
                    $request->session()->forget('stats_numberOfOtherMember');
                    // addressSessionData
                    $request->session()->forget('stats_presentDivisionId');
                    $request->session()->forget('stats_presentDistrictId');
                    $request->session()->forget('stats_presentUpazilaId');
                    $request->session()->forget('stats_presentMunicipalityId');
                    $request->session()->forget('stats_presentWardId');
                    $request->session()->forget('stats_presentUnionId');
                    $request->session()->forget('stats_presentVillageId');
                    $request->session()->forget('stats_presentPostOfficeId');
                    // $request->session()->put('Fishermen_Family_Information', $add['storeFishermenAddressInformation']);
                    flash('Fishing Information Added Successfully')->success();
                    return redirect()->route('getAllFishersInfo');
                }
            } else {
                flash('Error')->error();
                return back();
            }
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function createFishermenBasicInformation(Request $request)
    {
        return view('admin.fishermen-info-card-print.create-basic-info');
    }

    public function storeFishermenInfoCardPrintBasicInformation(Request $request)
    {
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
        $add = $this->fishermenInfoCardPrint->storeFisherBasicInformation($data);
        return $add;
    }
    public function viewFisherInfo($id)
    {
       $data = $this->fishermenInfoCardPrint->viewFishermenInfo($id);
       $dataStats = $this->fishermenStats->viewFisherStatsInfo($data->id);

       $religionList = $this->religion->getReligionList();
       $divisionList = $this->division->getDivisionList();
       $districtList = $this->district->getDistrictList();
       
       $getPermanentUpazilaData = $this->upazila->getPermanentUpazila($data);
       $getPermanentMunicipalityData = $this->municipality->getPermanentMunicipality($data);
       $getPermanentWardData = $this->union->getPermanentWard($data);
       $getPermanentUnionData = $this->union->getPermanentUnion($data);
       $getPermanentVillageData = $this->village->getPermanentVillage($data);
       $getPermanentPostOfficeData = $this->postOffice->getPermanentPostOffice($data);

       $getPresentUpazilaData = $this->upazila->getPresentUpazila($dataStats);
       $getPresentMunicipalityData = $this->municipality->getPresentMunicipality($dataStats);
       $getPresentWardData = $this->union->getPresentWard($dataStats);
       $getPresentUnionData = $this->union->getPresentUnion($dataStats);
       $getPresentVillageData = $this->village->getPresentVillage($dataStats);
       $getPresentPostOfficeData = $this->postOffice->getPresentPostOffice($dataStats);

       $placeOfFishingList = $this->placeOfFishings->getFishingPlace();
       $fishCategoryList = $this->fishCategory->getFishCategory();
       $fishingEquipmentList = $this->fishingEquipment->getFishingEquipment();
       $fishSalePlacesList = $this->fishSalePlaces->getFishSalePlaces();

       return view('admin.fishermen-info-card-print.view-fisher-info')->with([
           'data' => $data,
           'dataStats' => $dataStats,
           'religionList' => $religionList,
           'districtList' => $districtList,
           'divisionList' =>  $divisionList,
        
           'getPermanentUpazilaData' =>  $getPermanentUpazilaData,
           'getPermanentMunicipalityData' =>  $getPermanentMunicipalityData,
           'getPermanentUnionData' =>  $getPermanentUnionData,
           'getPermanentWardData' =>  $getPermanentWardData,
           'getPermanentVillageData' =>  $getPermanentVillageData,
           'getPermanentPostOfficeData' =>  $getPermanentPostOfficeData,

           'getPresentUpazilaData' =>  $getPresentUpazilaData,
           'getPresentMunicipalityData' =>  $getPresentMunicipalityData,
           'getPresentUnionData' =>  $getPresentUnionData,
           'getPresentWardData' =>  $getPresentWardData,
           'getPresentVillageData' =>  $getPresentVillageData,
           'getPresentPostOfficeData' =>  $getPresentPostOfficeData,
           
           'placeOfFishingList' =>  $placeOfFishingList,
           'fishCategoryList' =>  $fishCategoryList,
           'fishingEquipmentList' =>  $fishingEquipmentList,
           'fishSalePlacesList' =>  $fishSalePlacesList,
       ]);
    }
    public function viewFisherIdCard($id)
    {
       $data = $this->fishermenInfoCardPrint->viewFishermenInfo($id);
       $divisionList = $this->division->getDivisionList();
       $districtList = $this->district->getDistrictList();
       
       $getPermanentUpazilaData = $this->upazila->getPermanentUpazila($data);
       $getPermanentMunicipalityData = $this->municipality->getPermanentMunicipality($data);
       $getPermanentWardData = $this->union->getPermanentWard($data);
       $getPermanentUnionData = $this->union->getPermanentUnion($data);
       $getPermanentVillageData = $this->village->getPermanentVillage($data);
       $getPermanentPostOfficeData = $this->postOffice->getPermanentPostOffice($data);
       return view('admin.fishermen-info-card-print.view-fisher-id-card')->with([
           'data' => $data,
           'districtList' => $districtList,
           'divisionList' =>  $divisionList,
        
           'getPermanentUpazilaData' =>  $getPermanentUpazilaData,
           'getPermanentMunicipalityData' =>  $getPermanentMunicipalityData,
           'getPermanentUnionData' =>  $getPermanentUnionData,
           'getPermanentWardData' =>  $getPermanentWardData,
           'getPermanentVillageData' =>  $getPermanentVillageData,
           'getPermanentPostOfficeData' =>  $getPermanentPostOfficeData,
       ]);
    }
    public function editFisherInfo($id)
    {
        //   return "OK"
        $data = $this->fishermenInfoCardPrint->viewFishermenInfo($id);
        $dataStats = $this->fishermenStats->viewFisherStatsInfo($data->id);
        $religionList = $this->religion->getReligionList();
        $educationList = $this->education->getEducationList();
        $divisionList = $this->division->getDivisionList();
        $districtList = $this->district->getDistrictList();

        $maritalStatusList = $this->maritalStatus->getMaritalStatusList();
        $timeOfFishingList = $this->timeOfFishings->getTimeOfFishings();
        $placeOfFishingList = $this->placeOfFishings->getFishingPlace();
        $fishCategoryList = $this->fishCategory->getFishCategory();
        $fishingEquipmentList = $this->fishingEquipment->getFishingEquipment();
        $howToFishingList = $this->howToFishing->getHowToFishing();
        $groupMemberList = $this->groupMember->getGroupMember();
        $ownerOfNetList = $this->ownerOfNet->getOwnerOfNet();
        $typeOfVesselsList = $this->typeOfVessels->getTypeOfVessels();
        $ownerOfVesselsList = $this->ownerOfVessels->getOwnerOfVessels();
        $typeOfEmploymentStatusinVesselsList = $this->typeOfEmploymentStatusinVessels->getTypeOfEmploymentStatusinVessels();
        $fishSalePlacesList = $this->fishSalePlaces->getFishSalePlaces();
        $yearlyLoanList = $this->yearlyLoan->getYearlyLoan();
        $yearlySavingList = $this->yearlySaving->getYearlySaving();
        $deficiencyPeriodList = $this->deficiencyPeriod->getDeficiencyPeriod();

        $getEditDistrictList = $this->district->getEditDistrict($data->divisionId);
        $getEditUpazilaList = $this->upazila->getEditUpazila($data);
        $getEditMunicipalityList = $this->municipality->getEditMunicipality($data);
        $getEditWardList = $this->union->getEditWard($data);
        $getEditUnionList = $this->union->getEditUnion($data);
        $getEditVillageList = $this->village->getEditVillage($data);
        $getEditPostOfficeList = $this->postOffice->getEditPostOffice($data);
        
        $getPresentEditDistrictList = $this->district->getPresentEditDistrict($dataStats->presentDivisionId);
        $getPresentEditUpazilaList = $this->upazila->getPresentEditUpazila($dataStats);
        $getPresentEditMunicipalityList = $this->municipality->getPresentEditMunicipality($dataStats);
        $getPresentEditWardList = $this->union->getPresentEditWard($dataStats);
        $getPresentEditUnionList = $this->union->getPresentEditUnion($dataStats);
        $getPresentEditVillageList = $this->village->getPresentEditVillage($dataStats);
        $getPresentEditPostOfficeList = $this->postOffice->getPresentEditPostOffice($dataStats);

        return view('admin.fishermen-info-card-print.edit-fisher-info')->with([
            'data' => $data,
            'dataStats' => $dataStats,
            'religionList' => $religionList,
            'educationList' => $educationList,
            'districtList' => $districtList,
            'divisionList' =>  $divisionList,
            
            'permanentdivisionList' =>  $divisionList,
            'maritalStatusList' => $maritalStatusList,
            'timeOfFishingList' =>  $timeOfFishingList,
            'placeOfFishingList' =>  $placeOfFishingList,
            'fishCategoryList' =>  $fishCategoryList,
            'fishingEquipmentList' =>  $fishingEquipmentList,
            'howToFishingList' =>  $howToFishingList,
            'groupMemberList' =>  $groupMemberList,
            'ownerOfNetList' =>  $ownerOfNetList,
            'typeOfVesselsList' =>  $typeOfVesselsList,
            'ownerOfVesselsList' =>  $ownerOfVesselsList,
            'typeOfEmploymentStatusinVesselsList' =>  $typeOfEmploymentStatusinVesselsList,
            'fishSalePlacesList' =>  $fishSalePlacesList,
            'yearlyLoanList' =>  $yearlyLoanList,
            'yearlySavingList' =>  $yearlySavingList,
            'deficiencyPeriodList' =>  $deficiencyPeriodList,

            'getEditDistrictList' =>  $getEditDistrictList,
            'getEditUpazilaList' =>  $getEditUpazilaList,
            'getEditMunicipalityList' =>  $getEditMunicipalityList,
            'getEditWardList' =>  $getEditWardList,
            'getEditUnionList' =>  $getEditUnionList,
            'getEditVillageList' =>  $getEditVillageList,
            'getEditPostOfficeList' =>  $getEditPostOfficeList,

            'getPresentEditDistrictList' =>  $getPresentEditDistrictList,
            'getPresentEditUpazilaList' =>  $getPresentEditUpazilaList,
            'getPresentEditMunicipalityList' =>  $getPresentEditMunicipalityList,
            'getPresentEditWardList' =>  $getPresentEditWardList,
            'getPresentEditUnionList' =>  $getPresentEditUnionList,
            'getPresentEditVillageList' =>  $getPresentEditVillageList,
            'getPresentEditPostOfficeList' =>  $getPresentEditPostOfficeList,
        ]);
    }
    public function updateFisherInfo(Request $request){
        // return $request->hasFile('newPhoto');
        if ($request->hasFile('newPhoto')) {
            $file=$request->file('newPhoto');
            $image_name=str_replace(' ', '_', substr($request->fishermanNameEng, 0, 5)) . '-'. uniqid() . '.'. $file->getClientOriginalExtension();
            $image=Image::make($file);

            $image->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                }

            );

            $img_canvas=Image::canvas(500, 500);
            $img_canvas->insert($image, 'center');
            $img_canvas->save(base_path('public/uploads/'. $image_name));
            $newPath=$image_name;
        }
        if ($request->newPhoto) {
            $imagePath=$newPath;
        } else {
            $imagePath=$request->oldPhoto;
        }
        
        $userId = Auth::user()->id;
        $data = (object) $request->all();
        // return $data;
        $cardData = $this->fishermenInfoCardPrint->updateFishermenCard($userId,$data,$imagePath);
        if ($cardData) {
            $statsData = $this->fishermenStats->updateFishermenStats($cardData->id,$data);
            // return $statsData;
            if ($statsData) {
                flash('Successfully Updated')->success();
                return back();
            } else {
                flash('Error')->error();
                return back();
            }
            
            
             }
    }

    public function getFiserInfobyDivisionandDistrict()
    {
        $divisions= DB::table('divisions')->get();
        return view('admin.reports.getFisherListbyDivisionandDistrict')->with(
            [
                'divisions'=>$divisions,
            ]
        );
    }

    public function getFisherReportbyDistrictandDivision(Request $request)
    {
        $divisionId = $request->divisionId;
        $districtId = $request->districtId;
        $printLimit = $request->printLimit;

        if ($printLimit == 0 && $divisionId!='' && $districtId=='') {
            $data = FishermenInfoCardPrint::join('divisions','divisions.divisionId','=','fishermen_info_card_prints.divisionId')
            ->join('districts','districts.districtId','=','fishermen_info_card_prints.districtId')
            ->join('post_offices','post_offices.postId','=','fishermen_info_card_prints.postOfficeId')
            ->join('fishermen_info_stats_infos','fishermen_info_stats_infos.dofId','=','fishermen_info_card_prints.id')
            ->join('religions','religions.religionId','=','fishermen_info_stats_infos.religion')
            ->join('education','education.id','=','fishermen_info_stats_infos.education')
            ->join('time_of_fishings','time_of_fishings.id','=','fishermen_info_stats_infos.timeOfFishing')
            ->join('how_to_fishings','how_to_fishings.id','=','fishermen_info_stats_infos.howToFishing')
            ->where('fishermen_info_card_prints.divisionId', '=', $divisionId)
            ->get(['formId','fId','fishermanNameEng','nationalIdNo','gender','fathersName','mothersName','spouseName','dateOfBirth','divisions.divisionEng as divisionName','districts.districtEng as districtName','post_offices.postOfficeEnglish as postOfficeName','religions.religionEnglish as religion','education.educationalQualificationEng as education','fishermen_info_stats_infos.totalFamilyMember as totalFamilyMember','fishermen_info_stats_infos.numberOfFather as numberOfFather','fishermen_info_stats_infos.numberOfMother  as numberOfMother','fishermen_info_stats_infos.numberOfSon as numberOfSon','fishermen_info_stats_infos.numberOfDaughter as numberOfDaughter','fishermen_info_stats_infos.numberOfSpouse as numberOfSpouse','fishermen_info_stats_infos.mobile as mobile','fishermen_info_stats_infos.annualIncome as annualIncome','fishermen_info_stats_infos.incomeMainProfession as incomeMainProfession','fishermen_info_stats_infos.incomeSubProfession as incomeSubProfession','time_of_fishings.timeOfFishingEng as timeOfFishingEng','how_to_fishings.howToFishingEng as howToFishing']);  
        }
        elseif($printLimit != 0 && $divisionId!='' && $districtId=='')
        {
            $data = FishermenInfoCardPrint::join('divisions','divisions.divisionId','=','fishermen_info_card_prints.divisionId')
            ->join('districts','districts.districtId','=','fishermen_info_card_prints.districtId')
            ->join('post_offices','post_offices.postId','=','fishermen_info_card_prints.postOfficeId')
            ->join('fishermen_info_stats_infos','fishermen_info_stats_infos.dofId','=','fishermen_info_card_prints.id')
            ->join('religions','religions.religionId','=','fishermen_info_stats_infos.religion')
            ->join('education','education.id','=','fishermen_info_stats_infos.education')
            ->join('time_of_fishings','time_of_fishings.id','=','fishermen_info_stats_infos.timeOfFishing')
            ->join('how_to_fishings','how_to_fishings.id','=','fishermen_info_stats_infos.howToFishing')
            ->where('fishermen_info_card_prints.divisionId', '=', $divisionId)
            ->take($printLimit)
            ->get(['formId','fId','fishermanNameEng','nationalIdNo','gender','fathersName','mothersName','spouseName','dateOfBirth','divisions.divisionEng as divisionName','districts.districtEng as districtName','post_offices.postOfficeEnglish as postOfficeName','religions.religionEnglish as religion','education.educationalQualificationEng as education','fishermen_info_stats_infos.totalFamilyMember as totalFamilyMember','fishermen_info_stats_infos.numberOfFather as numberOfFather','fishermen_info_stats_infos.numberOfMother  as numberOfMother','fishermen_info_stats_infos.numberOfSon as numberOfSon','fishermen_info_stats_infos.numberOfDaughter as numberOfDaughter','fishermen_info_stats_infos.numberOfSpouse as numberOfSpouse','fishermen_info_stats_infos.mobile as mobile','fishermen_info_stats_infos.annualIncome as annualIncome','fishermen_info_stats_infos.incomeMainProfession as incomeMainProfession','fishermen_info_stats_infos.incomeSubProfession as incomeSubProfession','time_of_fishings.timeOfFishingEng as timeOfFishingEng','how_to_fishings.howToFishingEng as howToFishing']);  
        }
        elseif ($printLimit==0 && $divisionId!='' && $districtId!='') {
            $data = FishermenInfoCardPrint::join('divisions','divisions.divisionId','=','fishermen_info_card_prints.divisionId')
            ->join('districts','districts.districtId','=','fishermen_info_card_prints.districtId')
            ->join('post_offices','post_offices.postId','=','fishermen_info_card_prints.postOfficeId')
            ->join('fishermen_info_stats_infos','fishermen_info_stats_infos.dofId','=','fishermen_info_card_prints.id')
            ->join('religions','religions.religionId','=','fishermen_info_stats_infos.religion')
            ->join('education','education.id','=','fishermen_info_stats_infos.education')
            ->join('time_of_fishings','time_of_fishings.id','=','fishermen_info_stats_infos.timeOfFishing')
            ->join('how_to_fishings','how_to_fishings.id','=','fishermen_info_stats_infos.howToFishing')
            ->where('fishermen_info_card_prints.divisionId', '=', $divisionId)
            ->where('fishermen_info_card_prints.districtId', '=', $districtId)
            ->get(['formId','fId','fishermanNameEng','nationalIdNo','gender','fathersName','mothersName','spouseName','dateOfBirth','divisions.divisionEng as divisionName','districts.districtEng as districtName','post_offices.postOfficeEnglish as postOfficeName','religions.religionEnglish as religion','education.educationalQualificationEng as education','fishermen_info_stats_infos.totalFamilyMember as totalFamilyMember','fishermen_info_stats_infos.numberOfFather as numberOfFather','fishermen_info_stats_infos.numberOfMother  as numberOfMother','fishermen_info_stats_infos.numberOfSon as numberOfSon','fishermen_info_stats_infos.numberOfDaughter as numberOfDaughter','fishermen_info_stats_infos.numberOfSpouse as numberOfSpouse','fishermen_info_stats_infos.mobile as mobile','fishermen_info_stats_infos.annualIncome as annualIncome','fishermen_info_stats_infos.incomeMainProfession as incomeMainProfession','fishermen_info_stats_infos.incomeSubProfession as incomeSubProfession','time_of_fishings.timeOfFishingEng as timeOfFishingEng','how_to_fishings.howToFishingEng as howToFishing']);  
        }
        elseif ($printLimit!= 0 && $divisionId!='' && $districtId!='') {
            $data = FishermenInfoCardPrint::join('divisions','divisions.divisionId','=','fishermen_info_card_prints.divisionId')
            ->join('districts','districts.districtId','=','fishermen_info_card_prints.districtId')
            ->join('post_offices','post_offices.postId','=','fishermen_info_card_prints.postOfficeId')
            ->join('fishermen_info_stats_infos','fishermen_info_stats_infos.dofId','=','fishermen_info_card_prints.id')
            ->join('religions','religions.religionId','=','fishermen_info_stats_infos.religion')
            ->join('education','education.id','=','fishermen_info_stats_infos.education')
            ->join('time_of_fishings','time_of_fishings.id','=','fishermen_info_stats_infos.timeOfFishing')
            ->join('how_to_fishings','how_to_fishings.id','=','fishermen_info_stats_infos.howToFishing')
            ->where('fishermen_info_card_prints.divisionId', '=', $divisionId)
            ->where('fishermen_info_card_prints.districtId', '=', $districtId)
            ->take($printLimit)
            ->get(['formId','fId','fishermanNameEng','nationalIdNo','gender','fathersName','mothersName','spouseName','dateOfBirth','divisions.divisionEng as divisionName','districts.districtEng as districtName','post_offices.postOfficeEnglish as postOfficeName','religions.religionEnglish as religion','education.educationalQualificationEng as education','fishermen_info_stats_infos.totalFamilyMember as totalFamilyMember','fishermen_info_stats_infos.numberOfFather as numberOfFather','fishermen_info_stats_infos.numberOfMother  as numberOfMother','fishermen_info_stats_infos.numberOfSon as numberOfSon','fishermen_info_stats_infos.numberOfDaughter as numberOfDaughter','fishermen_info_stats_infos.numberOfSpouse as numberOfSpouse','fishermen_info_stats_infos.mobile as mobile','fishermen_info_stats_infos.annualIncome as annualIncome','fishermen_info_stats_infos.incomeMainProfession as incomeMainProfession','fishermen_info_stats_infos.incomeSubProfession as incomeSubProfession','time_of_fishings.timeOfFishingEng as timeOfFishingEng','how_to_fishings.howToFishingEng as howToFishing']);  
        }
        $list = array(
            'fisherList' => $data,
        );
        $fileName = 'fisher-man-list.pdf';
        $mPdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 15,
            'margin_bottom' => 20,
            'margin_header' => 10,
            'margin_footer' => 10,
            'format' => 'A4-L',
            'orientation' => 'L'
        ]);
        $html = \View::make('getFisherDatabyDistrictandDivision',['fisherList' => $data]);
        $html = $html->render();
        $mPdf->SetHeader(' |Fishers List|Page-{PAGENO}');
        $mPdf->SetFooter('Footer Text');
        $mPdf->WriteHTML($html);
        $mPdf->Output($fileName, 'I');
    }

    public function getAjaxReportbyDivisionandDistrict(Request $request)
    {
        $divisionId = $request->divisionId;
        $districtId = $request->districtId;
        $printLimit = $request->printLimit;
      
        if ($request->ajax()) {
            if ($printLimit == 0 && $divisionId!='' && $districtId=='') {
                $data = FishermenInfoCardPrint::join('divisions','divisions.divisionId','=','fishermen_info_card_prints.divisionId')
                ->join('districts','districts.districtId','=','fishermen_info_card_prints.districtId')
                ->join('post_offices','post_offices.postId','=','fishermen_info_card_prints.postOfficeId')
                ->join('fishermen_info_stats_infos','fishermen_info_stats_infos.dofId','=','fishermen_info_card_prints.id')
                ->join('religions','religions.religionId','=','fishermen_info_stats_infos.religion')
                ->join('education','education.id','=','fishermen_info_stats_infos.education')
                ->join('time_of_fishings','time_of_fishings.id','=','fishermen_info_stats_infos.timeOfFishing')
                ->join('how_to_fishings','how_to_fishings.id','=','fishermen_info_stats_infos.howToFishing')
                ->where('fishermen_info_card_prints.divisionId', '=', $divisionId)
                ->get(['fishermen_info_card_prints.id','formId','fId','fishermanNameEng','nationalIdNo','gender','fathersName','mothersName','spouseName','dateOfBirth','divisions.divisionEng as divisionName','districts.districtEng as districtName','post_offices.postOfficeEnglish as postOfficeName','religions.religionEnglish as religion','education.educationalQualificationEng as education','fishermen_info_stats_infos.totalFamilyMember as totalFamilyMember','fishermen_info_stats_infos.numberOfFather as numberOfFather','fishermen_info_stats_infos.numberOfMother  as numberOfMother','fishermen_info_stats_infos.numberOfSon as numberOfSon','fishermen_info_stats_infos.numberOfDaughter as numberOfDaughter','fishermen_info_stats_infos.numberOfSpouse as numberOfSpouse','fishermen_info_stats_infos.mobile as mobile','fishermen_info_stats_infos.annualIncome as annualIncome','fishermen_info_stats_infos.incomeMainProfession as incomeMainProfession','fishermen_info_stats_infos.incomeSubProfession as incomeSubProfession','time_of_fishings.timeOfFishingEng as timeOfFishingEng','how_to_fishings.howToFishingEng as howToFishing']);  
            }
            elseif($printLimit != 0 && $divisionId!='' && $districtId=='')
            {
                $data = FishermenInfoCardPrint::join('divisions','divisions.divisionId','=','fishermen_info_card_prints.divisionId')
                ->join('districts','districts.districtId','=','fishermen_info_card_prints.districtId')
                ->join('post_offices','post_offices.postId','=','fishermen_info_card_prints.postOfficeId')
                ->join('fishermen_info_stats_infos','fishermen_info_stats_infos.dofId','=','fishermen_info_card_prints.id')
                ->join('religions','religions.religionId','=','fishermen_info_stats_infos.religion')
                ->join('education','education.id','=','fishermen_info_stats_infos.education')
                ->join('time_of_fishings','time_of_fishings.id','=','fishermen_info_stats_infos.timeOfFishing')
                ->join('how_to_fishings','how_to_fishings.id','=','fishermen_info_stats_infos.howToFishing')
                ->where('fishermen_info_card_prints.divisionId', '=', $divisionId)
                ->take($printLimit)
                ->get(['fishermen_info_card_prints.id','formId','fId','fishermanNameEng','nationalIdNo','gender','fathersName','mothersName','spouseName','dateOfBirth','divisions.divisionEng as divisionName','districts.districtEng as districtName','post_offices.postOfficeEnglish as postOfficeName','religions.religionEnglish as religion','education.educationalQualificationEng as education','fishermen_info_stats_infos.totalFamilyMember as totalFamilyMember','fishermen_info_stats_infos.numberOfFather as numberOfFather','fishermen_info_stats_infos.numberOfMother  as numberOfMother','fishermen_info_stats_infos.numberOfSon as numberOfSon','fishermen_info_stats_infos.numberOfDaughter as numberOfDaughter','fishermen_info_stats_infos.numberOfSpouse as numberOfSpouse','fishermen_info_stats_infos.mobile as mobile','fishermen_info_stats_infos.annualIncome as annualIncome','fishermen_info_stats_infos.incomeMainProfession as incomeMainProfession','fishermen_info_stats_infos.incomeSubProfession as incomeSubProfession','time_of_fishings.timeOfFishingEng as timeOfFishingEng','how_to_fishings.howToFishingEng as howToFishing']);  
            }
            elseif ($printLimit==0 && $divisionId!='' && $districtId!='') {
                $data = FishermenInfoCardPrint::join('divisions','divisions.divisionId','=','fishermen_info_card_prints.divisionId')
                ->join('districts','districts.districtId','=','fishermen_info_card_prints.districtId')
                ->join('post_offices','post_offices.postId','=','fishermen_info_card_prints.postOfficeId')
                ->join('fishermen_info_stats_infos','fishermen_info_stats_infos.dofId','=','fishermen_info_card_prints.id')
                ->join('religions','religions.religionId','=','fishermen_info_stats_infos.religion')
                ->join('education','education.id','=','fishermen_info_stats_infos.education')
                ->join('time_of_fishings','time_of_fishings.id','=','fishermen_info_stats_infos.timeOfFishing')
                ->join('how_to_fishings','how_to_fishings.id','=','fishermen_info_stats_infos.howToFishing')
                ->where('fishermen_info_card_prints.divisionId', '=', $divisionId)
                ->where('fishermen_info_card_prints.districtId', '=', $districtId)
                ->get(['fishermen_info_card_prints.id','formId','fId','fishermanNameEng','nationalIdNo','gender','fathersName','mothersName','spouseName','dateOfBirth','divisions.divisionEng as divisionName','districts.districtEng as districtName','post_offices.postOfficeEnglish as postOfficeName','religions.religionEnglish as religion','education.educationalQualificationEng as education','fishermen_info_stats_infos.totalFamilyMember as totalFamilyMember','fishermen_info_stats_infos.numberOfFather as numberOfFather','fishermen_info_stats_infos.numberOfMother  as numberOfMother','fishermen_info_stats_infos.numberOfSon as numberOfSon','fishermen_info_stats_infos.numberOfDaughter as numberOfDaughter','fishermen_info_stats_infos.numberOfSpouse as numberOfSpouse','fishermen_info_stats_infos.mobile as mobile','fishermen_info_stats_infos.annualIncome as annualIncome','fishermen_info_stats_infos.incomeMainProfession as incomeMainProfession','fishermen_info_stats_infos.incomeSubProfession as incomeSubProfession','time_of_fishings.timeOfFishingEng as timeOfFishingEng','how_to_fishings.howToFishingEng as howToFishing']);  
            }
            elseif ($printLimit!= 0 && $divisionId!='' && $districtId!='') {
                $data = FishermenInfoCardPrint::join('divisions','divisions.divisionId','=','fishermen_info_card_prints.divisionId')
                ->join('districts','districts.districtId','=','fishermen_info_card_prints.districtId')
                ->join('post_offices','post_offices.postId','=','fishermen_info_card_prints.postOfficeId')
                ->join('fishermen_info_stats_infos','fishermen_info_stats_infos.dofId','=','fishermen_info_card_prints.id')
                ->join('religions','religions.religionId','=','fishermen_info_stats_infos.religion')
                ->join('education','education.id','=','fishermen_info_stats_infos.education')
                ->join('time_of_fishings','time_of_fishings.id','=','fishermen_info_stats_infos.timeOfFishing')
                ->join('how_to_fishings','how_to_fishings.id','=','fishermen_info_stats_infos.howToFishing')
                ->where('fishermen_info_card_prints.divisionId', '=', $divisionId)
                ->where('fishermen_info_card_prints.districtId', '=', $districtId)
                ->take($printLimit)
                ->get(['fishermen_info_card_prints.id','formId','fId','fishermanNameEng','nationalIdNo','gender','fathersName','mothersName','spouseName','dateOfBirth','divisions.divisionEng as divisionName','districts.districtEng as districtName','post_offices.postOfficeEnglish as postOfficeName','religions.religionEnglish as religion','education.educationalQualificationEng as education','fishermen_info_stats_infos.totalFamilyMember as totalFamilyMember','fishermen_info_stats_infos.numberOfFather as numberOfFather','fishermen_info_stats_infos.numberOfMother  as numberOfMother','fishermen_info_stats_infos.numberOfSon as numberOfSon','fishermen_info_stats_infos.numberOfDaughter as numberOfDaughter','fishermen_info_stats_infos.numberOfSpouse as numberOfSpouse','fishermen_info_stats_infos.mobile as mobile','fishermen_info_stats_infos.annualIncome as annualIncome','fishermen_info_stats_infos.incomeMainProfession as incomeMainProfession','fishermen_info_stats_infos.incomeSubProfession as incomeSubProfession','time_of_fishings.timeOfFishingEng as timeOfFishingEng','how_to_fishings.howToFishingEng as howToFishing']);  
            }
           
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($user) {
                    return '<div class="btn-group"><a href="/view-fisher-info/'.$user->id.'" class="edit btn btn-primary btn-sm">View</a><a href="/edit-fisher-info/'.$user->id.'" class="edit btn btn-success btn-sm">Edit</a></div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.reports.getFisherListbyDivisionandDistrict');
    }
}
