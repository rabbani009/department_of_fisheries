<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\DeficiencyPeriod;
use App\Models\Education;
use App\Models\FishCategory;
use App\Models\FishermenInfoCardPrint;
use App\Models\FishingPlace;
use App\Models\FishermenInfoStatsInfo;
use App\Models\FishingEquipment;
use App\Models\FishSalePlaces;
use App\Models\HowToFishing;
use App\Models\MaritalStatus;
use App\Models\OwnerOfNet;
use App\Models\OwnerOfVessels;
use App\Models\Religion;
use App\Models\TimeOfFishing;
use App\Models\TypeOfVessels;
use App\Models\YearlyLoan;
use App\Models\YearlySaving;
use App\Repositories\FishermenInfoCardPrint\FishermenInfoCardPrintInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

use function PHPUnit\Framework\isEmpty;

class MasterReportController extends Controller
{
    private $fishers,
        $education,
        $maritalStatus,
        $yearlyLoan,
        $yearlySaving,
        $timeOfFishings,
        $fishingEquipment,
        $deficiencyPeriod,
        $typeOfVessels,
        $howToFishing,
        $ownerOfVessels,
        $fishSalePlaces,
        $ownerOfNet,
        $fishCategory,
        $religion;
    public function __construct(
        Education $education,
        FishermenInfoCardPrintInterface $fishers,
        MaritalStatus $maritalStatus,
        YearlyLoan $yearlyLoan,
        YearlySaving $yearlySaving,
        DeficiencyPeriod $deficiencyPeriod,
        OwnerOfNet $ownerOfNet,
        TypeOfVessels $typeOfVessels,
        OwnerOfVessels $ownerOfVessels,
        FishSalePlaces $fishSalePlaces,
        FishingPlace $placeOfFishings,
        FishCategory $fishCategory,
        FishingEquipment $fishingEquipment,
        TimeOfFishing $timeOfFishings,
        HowToFishing $howToFishing,
        Religion $religion
    ) {
        $this->middleware('auth');
        $this->middleware('preventBackHistory'); 
        $this->fishermenInfoCardPrint = $fishers;
        $this->religion = $religion;
        $this->maritalStatus = $maritalStatus;
        $this->education = $education;
        $this->timeOfFishings = $timeOfFishings;
        $this->yearlyLoan = $yearlyLoan;
        $this->yearlySaving = $yearlySaving;
        $this->deficiencyPeriod = $deficiencyPeriod;
        $this->ownerOfNet = $ownerOfNet;
        $this->typeOfVessels = $typeOfVessels;
        $this->ownerOfVessels = $ownerOfVessels;
        $this->fishSalePlaces = $fishSalePlaces;
        $this->howToFishing = $howToFishing;
        $this->placeOfFishings = $placeOfFishings;
        $this->fishCategory = $fishCategory;
        $this->fishingEquipment = $fishingEquipment;
    }
    public function getFisherMasterReport()
    {
        $divisions = DB::table('divisions')->get();
        $religionList = $this->religion->getReligionList();
        $educationList = $this->education->getEducationList();
        $maritalStatusList = $this->maritalStatus->getMaritalStatusList();
        $yearlySavingList = $this->yearlySaving->getYearlySaving();
        $yearlyLoanList = $this->yearlyLoan->getYearlyLoan();
        $deficiencyPeriodList = $this->deficiencyPeriod->getDeficiencyPeriod();
        $timeOfFishingList = $this->timeOfFishings->getTimeOfFishings();
        $placeOfFishingList = $this->placeOfFishings->getFishingPlace();
        $fishCategoryList = $this->fishCategory->getFishCategory();
        $fishingEquipmentList = $this->fishingEquipment->getFishingEquipment();
        $howToFishingList = $this->howToFishing->getHowToFishing();
        $ownerOfNetList = $this->ownerOfNet->getOwnerOfNet();
        $typeOfVesselsList = $this->typeOfVessels->getTypeOfVessels();
        $ownerOfVesselsList = $this->ownerOfVessels->getOwnerOfVessels();
        $fishSalePlacesList = $this->fishSalePlaces->getFishSalePlaces();

        return view('admin.master-report.getFishersMasterReport')->with(
            [
                'divisions' => $divisions,
                'religionList' => $religionList,
                'educationList' => $educationList,
                'maritalStatusList' => $maritalStatusList,
                'yearlySavingList' => $yearlySavingList,
                'yearlyLoanList' => $yearlyLoanList,
                'deficiencyPeriodList' => $deficiencyPeriodList,
                'timeOfFishingList' => $timeOfFishingList,
                'placeOfFishingList' => $placeOfFishingList,
                'fishCategoryList' => $fishCategoryList,
                'fishingEquipmentList' => $fishingEquipmentList,
                'howToFishingList' => $howToFishingList,
                'ownerOfNetList' =>  $ownerOfNetList,
                'typeOfVesselsList' =>  $typeOfVesselsList,
                'ownerOfVesselsList' =>  $ownerOfVesselsList,
                'fishSalePlacesList' =>  $fishSalePlacesList,
            ]
        );
    }
    //new line added as test
    public function getMasterReportData(Request $request)
    {
        $divisionId = $request->divisionId;
        $districtId = $request->districtId;
        $upazilaId = $request->upazilaId;
        $genderId = $request->genderId;
        $religionId = $request->religionId;
        $educationId = $request->educationId;
        $maritalStatusId = $request->maritalStatusId;
        $yearlySavingId = $request->yearlySavingId;
        $ageStartId = $request->ageStartId;
        $ageEndId = $request->ageEndId;

        if (!empty($request->annualIncomeStartId)) {
            $annualIncomeStartId = $request->annualIncomeStartId;
        } else {
            $annualIncomeStartId = Null;
        }
        if (!empty($request->annualIncomeEndId)) {
            $annualIncomeEndId = $request->annualIncomeEndId;
        } else {
            $annualIncomeEndId = Null;
        }
        // return  $annualIncomeStartId;
        if (!empty($ageStartId)) {
            $dt = new Carbon();
            $ageStarDate = $dt->subYears($ageStartId)->format('Y-m-d');
        } else {
            $ageStarDate = Null;
        }

        if (!empty($ageEndId)) {
            $dt2 = new Carbon();
            $ageEndDate = $dt2->subYears($ageEndId)->format('Y-m-d');
        } else {
            $ageEndDate = Null;
        }

        // return $ageStarDate;
        // return $yearlySavingId;
        $yearlyLoanId = $request->yearlyLoanId;
        $deficiencyPeriodId = $request->deficiencyPeriodId;
        $fishingTimeId = $request->fishingTimeId;
        $placeOfFishingId = $request->placeOfFishingId;
        $typesOfFishId = $request->typesOfFishId;
        $fishingEquipmentId = $request->fishingEquipmentId;
        $fishingTypeId = $request->fishingTypeId;
        $ownershipNetId = $request->ownershipNetId;
        $typeOfVesselsId = $request->typeOfVesselsId;
        $ownerOfVesselsId = $request->ownerOfVesselsId;
        $fishSalePlaceId = $request->fishSalePlaceId;
        $priceOfVesselStartId = $request->priceOfVesselStartId;
        $priceOfVesselEndId = $request->priceOfVesselEndId;
        // return $fishingTimeId;
        $divisionText = $request->divisionText;
        $districtText = $request->districtText;
        $upazilaText = $request->upazilaText;
        $genderText = $request->genderText;
        $religionText = $request->religionText;
        $educationText = $request->educationText;
        $maritalStatusText = $request->maritalStatusText;
        $yearlySavingText = $request->yearlySavingText;
        $yearlyLoanText = $request->yearlyLoanText;
        $deficiencyPeriodText = $request->deficiencyPeriodText;
        $fishingTimeText = $request->fishingTimeText;
        $ageStartText = $request->ageStartText;
        $ageEndText = $request->ageEndText;
        $annualIncomeStartText = $request->annualIncomeStartText;
        $annualIncomeEndText = $request->annualIncomeEndText;
        $placeOfFishingText = $request->placeOfFishingText;
        $typesOfFishText = $request->typesOfFishText;
        $fishingEquipmentText = $request->fishingEquipmentText;
        $fishingTypeText = $request->fishingTypeText;
        $ownershipNetText = $request->ownershipNetText;
        $typeOfVesselsText = $request->typeOfVesselsText;
        $ownerOfVesselsText = $request->ownerOfVesselsText;
        $fishSalePlaceText = $request->fishSalePlaceText;
        $priceOfVesselStartText = $request->priceOfVesselStartText;
        $priceOfVesselEndText = $request->priceOfVesselEndText;

        $allVar = [
            'divisionId' => $divisionId,
            'districtId' => $districtId,
            'upazilaId' => $upazilaId,
            'genderId' => $genderId,
            'religionId' => $religionId,
            'educationId' => $educationId,
            'maritalStatusId' => $maritalStatusId,
            'yearlySavingId' => $yearlySavingId,
            'yearlyLoanId' => $yearlyLoanId,
            'deficiencyPeriodId' => $deficiencyPeriodId,
            'fishingTimeId' => $fishingTimeId,
            'annualIncomeStartId' => $annualIncomeStartId,
            'annualIncomeEndId' => $annualIncomeEndId,
            'placeOfFishingId' => $placeOfFishingId,
            'ageStarDate' => $ageStarDate,
            'ageEndDate' => $ageEndDate,
            'typesOfFishId' => $typesOfFishId,
            'fishingEquipmentId' => $fishingEquipmentId,
            'fishingTypeId' => $fishingTypeId,
            'ownershipNetId' => $ownershipNetId,
            'typeOfVesselsId' => $typeOfVesselsId,
            'ownerOfVesselsId' => $ownerOfVesselsId,
            'fishSalePlaceId' => $fishSalePlaceId,
            'priceOfVesselStartId' => $priceOfVesselStartId,
            'priceOfVesselEndId' => $priceOfVesselEndId,
        ];
        if ($divisionId != "") {
            $mainArray = array($divisionText);
        } else {
            $mainArray = array();
        }
        if ($districtId != "") {
            array_push($mainArray, $districtText);
        }
        if ($upazilaId != "") {
            array_push($mainArray, $upazilaText);
        }
        if (!empty($genderId)) {
            array_push($mainArray, $genderText);
        }
        if (!empty($religionId)) {
            array_push($mainArray, $religionText);
        }
        if (!empty($educationId)) {
            array_push($mainArray, $educationText);
        }
        if (!empty($maritalStatusId)) {
            array_push($mainArray, $maritalStatusText);
        }
        if (!empty($yearlySavingId)) {
            array_push($mainArray, $yearlySavingText);
        }
        if (!empty($yearlyLoanId)) {
            array_push($mainArray, $yearlyLoanText);
        }
        if (!empty($deficiencyPeriodId)) {
            array_push($mainArray, $deficiencyPeriodText);
        }
        if (!empty($fishingTimeId)) {
            array_push($mainArray, $fishingTimeText);
        }
        if (!empty($ageStartId)) {
            array_push($mainArray, $ageStartText);
        }
        if (!empty($ageEndId)) {
            array_push($mainArray, $ageEndText);
        }
        if (!empty($annualIncomeStartId)) {
            array_push($mainArray, $annualIncomeStartText);
        }
        if (!empty($annualIncomeEndId)) {
            array_push($mainArray, $annualIncomeEndText);
        }
        if (!empty($placeOfFishingId)) {
            array_push($mainArray, $placeOfFishingText);
        }
        if (!empty($typesOfFishId)) {
            array_push($mainArray, $typesOfFishText);
        }
        if (!empty($fishingEquipmentId)) {
            array_push($mainArray, $fishingEquipmentText);
        }
        if (!empty($fishingTypeId)) {
            array_push($mainArray, $fishingTypeText);
        }
        if (!empty($ownershipNetId)) {
            array_push($mainArray, $ownershipNetText);
        }
        if (!empty($typeOfVesselsId)) {
            array_push($mainArray, $typeOfVesselsText);
        }
        if (!empty($ownerOfVesselsId)) {
            array_push($mainArray, $ownerOfVesselsText);
        }
        if (!empty($fishSalePlaceId)) {
            array_push($mainArray, $fishSalePlaceText);
        }
        if (!empty($priceOfVesselStartId)) {
            array_push($mainArray, $priceOfVesselStartText);
        }
        if (!empty($priceOfVesselEndId)) {
            array_push($mainArray, $priceOfVesselEndText);
        }
        $text = implode(', ', $mainArray);

        $count = $this->fishermenInfoCardPrint->countFisherManbyArea($allVar);
        // return $count;
        return view('admin.master-report.getMasterReportTable')->with([
            'text' => $text,
            'divisionId' => $divisionId,
            'districtId' => $districtId,
            'upazilaId' => $upazilaId,
            'genderId' => $genderId,
            'religionId' => $religionId,
            'educationId' => $educationId,
            'maritalStatusId' => $maritalStatusId,
            'yearlySavingId' => $yearlySavingId,
            'yearlyLoanId' => $yearlyLoanId,
            'deficiencyPeriodId' => $deficiencyPeriodId,
            'fishingTimeId' => $fishingTimeId,
            'fishingTypeId' => $fishingTypeId,
            'placeOfFishingId' => $placeOfFishingId,
            'typesOfFishId' => $typesOfFishId,
            'fishingEquipmentId' => $fishingEquipmentId,
            'ownershipNetId' => $ownershipNetId,
            'typeOfVesselsId' => $typeOfVesselsId,
            'ownerOfVesselsId' => $ownerOfVesselsId,
            'fishSalePlaceId' => $fishSalePlaceId,
            'ageStarDate' => $ageStarDate,
            'ageEndDate' => $ageEndDate,
            'annualIncomeStartId' => $annualIncomeStartId,
            'annualIncomeEndId' => $annualIncomeEndId,
            'priceOfVesselStartId' => $priceOfVesselStartId,
            'priceOfVesselEndId' => $priceOfVesselEndId,
            'count' => $count
        ]);
    }
    public function getMasterReportDataList(Request $request)
    {
        $divisionId = $request->divisionId;
        $districtId = $request->districtId;
        $upazilaId = $request->upazilaId;

        // if ($request->ajax()) {
        //     $data = DB::table('fishermen_info_card_prints')->select('*')
        //     ->where('divisionId',$divisionId)
        //     ->get();    
        //     return DataTables::of($data)
        //         ->addIndexColumn()
        //         ->addColumn('action', function ($user) {
        //             return '<div class="btn-group"><a href="/view-fisher-info/'.$user->id.'" class="edit btn btn-primary btn-sm">View</a><a href="/edit-fisher-info/'.$user->id.'" class="edit btn btn-success btn-sm">Edit</a></div>';
        //         })
        //         ->rawColumns(['action'])
        //         ->make(true);
        //         return view('admin.master-report.getMasterReportTable')->with([
        //             'data' => $data,
        //         ]);
        // }


    }

    public function getMasterReportAllDataList(Request $request)
    {
        $divisionId  = $request->divisionId;
        $districtId = $request->districtId;
        $upazilaId = $request->upazilaId;
        $genderId = $request->genderId;
        $religionId = $request->religionId;
        $educationId = $request->educationId;
        $maritalStatusId = $request->maritalStatusId;
        $yearlySavingId = $request->yearlySavingId;
        $yearlyLoanId = $request->yearlyLoanId;
        $deficiencyPeriodId = $request->deficiencyPeriodId;
        $fishingTimeId = $request->fishingTimeId;
        $fishingTypeId = $request->fishingTypeId;
        $placeOfFishingId = $request->placeOfFishingId;
        $typesOfFishId = $request->typesOfFishId;
        $fishingEquipmentId = $request->fishingEquipmentId;
        $ownershipNetId = $request->ownershipNetId;
        $typeOfVesselsId = $request->typeOfVesselsId;
        $ownerOfVesselsId = $request->ownerOfVesselsId;
        $fishSalePlaceId = $request->fishSalePlaceId;
        $ageStarDate = $request->ageStarDate;
        $ageEndDate = $request->ageEndDate;
        $annualIncomeStartId = $request->annualIncomeStartId;
        $annualIncomeEndId = $request->annualIncomeEndId;
        $priceOfVesselStartId = $request->priceOfVesselStartId;
        $priceOfVesselEndId = $request->priceOfVesselEndId;

        $genderId = explode(",", $genderId);
        $religionId = explode(",", $religionId);
        $educationId = explode(",", $educationId);
        $maritalStatusId = explode(",", $maritalStatusId);
        $yearlySavingId = explode(",", $yearlySavingId);
        $yearlyLoanId = explode(",", $yearlyLoanId);
        $deficiencyPeriodId = explode(",", $deficiencyPeriodId);
        $fishingTimeId = explode(",", $fishingTimeId);
        $fishingTypeId = explode(",", $fishingTypeId);
        $placeOfFishingId = explode(",", $placeOfFishingId);
        $typesOfFishId = explode(",", $typesOfFishId);
        $fishingEquipmentId = explode(",", $fishingEquipmentId);
        $ownershipNetId = explode(",", $ownershipNetId);
        $typeOfVesselsId = explode(",", $typeOfVesselsId);
        $ownerOfVesselsId = explode(",", $ownerOfVesselsId);
        $fishSalePlaceId = explode(",", $fishSalePlaceId);
        $ageStarDate = explode(",", $ageStarDate);
        $ageEndDate = explode(",", $ageEndDate);
        $annualIncomeStartId = explode(",", $annualIncomeStartId);
        $annualIncomeEndId = explode(",", $annualIncomeEndId);
        $priceOfVesselStartId = explode(",", $priceOfVesselStartId);
        $priceOfVesselEndId = explode(",", $priceOfVesselEndId);

        return view('admin.master-report.getAllFisherInfoatMasterReport')->with([
            'divisionId' => $divisionId,
            'districtId' => $districtId,
            'upazilaId' => $upazilaId,
            'genderId' => $genderId,
            'religionId' => $religionId,
            'educationId' => $educationId,
            'maritalStatusId' => $maritalStatusId,
            'yearlySavingId' => $yearlySavingId,
            'yearlyLoanId' => $yearlyLoanId,
            'deficiencyPeriodId' => $deficiencyPeriodId,
            'fishingTimeId' => $fishingTimeId,
            'placeOfFishingId' => $placeOfFishingId,
            'typesOfFishId' => $typesOfFishId,
            'fishingEquipmentId' => $fishingEquipmentId,
            'ownershipNetId' => $ownershipNetId,
            'typeOfVesselsId' => $typeOfVesselsId,
            'ownerOfVesselsId' => $ownerOfVesselsId,
            'fishSalePlaceId' => $fishSalePlaceId,
            'ageStarDate' => $ageStarDate,
            'ageEndDate' => $ageEndDate,
            'annualIncomeStartId' => $annualIncomeStartId,
            'annualIncomeEndId' => $annualIncomeEndId,
            'priceOfVesselStartId' => $priceOfVesselStartId,
            'priceOfVesselEndId' => $priceOfVesselEndId,
            'fishingTypeId' => $fishingTypeId
        ]);
    }

    public function getMasterReportDatabyParameter(Request $request)
    {
       // $howToFishingList = $this->howToFishing->getHowToFishing();
        if (strlen($request->districtId) > 1) {
            $districtId = $request->districtId;
        } else {
            $districtId = '0' . $request->districtId;
        }
        if (strlen($request->upazilaId) > 1) {
            $upazilaId = $request->upazilaId;
        } else {
            $upazilaId = '0' . $request->upazilaId;
        }
        $divisionId = $request->divisionId;
        $genderId = $request->genderId;

        $religionId = $request->religionId;
        $educationId = $request->educationId;
        $maritalStatusId = $request->maritalStatusId;
        $yearlySavingId = $request->yearlySavingId;
        $yearlyLoanId = $request->yearlyLoanId;

        $deficiencyPeriodId = $request->deficiencyPeriodId;
        $fishingTimeId = $request->fishingTimeId;
        $fishingTypeId = $request->fishingTypeId;
        $placeOfFishingId = $request->placeOfFishingId;
        $ownershipNetId = $request->ownershipNetId;
        $typeOfVesselsId = $request->typeOfVesselsId;
        $ownerOfVesselsId = $request->ownerOfVesselsId;
        $fishSalePlaceId = $request->fishSalePlaceId;
        $ageStartId = $request->ageStarDate;
        $ageEndId = $request->ageEndDate;
        $annualIncomeStartId = $request->annualIncomeStartId;
        $annualIncomeEndId = $request->annualIncomeEndId;
        $priceOfVesselStartId = $request->priceOfVesselStartId;
        $priceOfVesselEndId = $request->priceOfVesselEndId;
        $typesOfFishId = $request->typesOfFishId;
        $fishingEquipmentId = $request->fishingEquipmentId;

        if ($request->ajax()) {
            $data =   FishermenInfoCardPrint::select('fishermen_info_card_prints.id', 'fishermen_info_card_prints.fId','fishermen_info_card_prints.formId','fishermen_info_card_prints.gender','fishermen_info_card_prints.fathersName','fishermen_info_card_prints.nationalIdNo', 'fishermen_info_card_prints.fishermanNameEng', 'fishermen_info_card_prints.dateOfBirth','fishermen_info_card_prints.gender')
                ->join('fishermen_info_stats_infos', 'fishermen_info_card_prints.id', '=', 'fishermen_info_stats_infos.dofId')
                ->when(isset($request->divisionId), function ($query) use ($request) {
                    $query->where('fishermen_info_card_prints.divisionId', $request->divisionId);
                })
                ->when(isset($request->districtId), function ($query) use ($districtId) {
                    $query->where('fishermen_info_card_prints.districtId', $districtId);
                })
                ->when(isset($request->upazilaId), function ($query) use ($upazilaId) {
                    $query->where('fishermen_info_card_prints.upazilaId', $upazilaId);
                })
                ->when(($genderId[0] == 'Male') || ($genderId[0] == 'Female'), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_card_prints.gender', $request->genderId);
                })
                ->when(!($religionId[0] == 0), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_stats_infos.religion', $request->religionId);
                })
                ->when(!($educationId[0] == 0), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_stats_infos.education', $request->educationId);
                })
                ->when(!($maritalStatusId[0] == 0), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_stats_infos.maritalStatus', $request->maritalStatusId);
                })
                ->when(!($yearlySavingId[0] == 0), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_stats_infos.yearlySaving', $request->yearlySavingId);
                })
                ->when(!($yearlyLoanId[0] == 0), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_stats_infos.yearlyLoan', $request->yearlyLoanId);
                })
                ->when(!($deficiencyPeriodId[0] == 0), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_stats_infos.dangerPeriodOfLiving', $request->deficiencyPeriodId);
                })
                ->when(!($fishingTimeId[0] == 0), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_stats_infos.timeOfFishing', $request->fishingTimeId);
                })
                ->when(!($fishingTypeId[0] == 0), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_stats_infos.howToFishing', $request->fishingTypeId);
                })
                ->when(!($placeOfFishingId[0] == 0), function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        foreach ($request->placeOfFishingId as $data) {
                            $q->orWhere('fishermen_info_stats_infos.placeOfFishing', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(!($typesOfFishId[0] == 0), function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        foreach ($request->typesOfFishId as $data) {
                            $q->orWhere('fishermen_info_stats_infos.typeOfFish', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(!($fishingEquipmentId[0] == 0), function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        foreach ($request->fishingEquipmentId as $data) {
                            $q->orWhere('fishermen_info_stats_infos.toolsType', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(!($ownershipNetId[0] == 0), function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        foreach ($request->ownershipNetId as $data) {
                            $q->orWhere('fishermen_info_stats_infos.ownerOfNet', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(!($typeOfVesselsId[0] == 0), function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        foreach ($request->typeOfVesselsId as $data) {
                            $q->orWhere('fishermen_info_stats_infos.typeOfVessels', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(!($ownerOfVesselsId[0] == 0), function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        foreach ($request->ownerOfVesselsId as $data) {
                            $q->orWhere('fishermen_info_stats_infos.ownerOfVessels', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(!($fishSalePlaceId[0] == 0), function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        foreach ($request->fishSalePlaceId as $data) {
                            $q->orWhere('fishermen_info_stats_infos.salePlaceOfFish', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(!($ageStartId[0] == 0), function ($query) use ($request) {
                    $query->whereDate('fishermen_info_card_prints.dateOfBirth', '<=', $request->ageStarDate);
                })
                ->when(!($ageEndId[0] == 0), function ($query) use ($request) {
                    $query->whereDate('fishermen_info_card_prints.dateOfBirth', '>=', $request->ageEndDate);
                })
                ->when(!($annualIncomeStartId[0] == 0), function ($query) use ($request) {
                    $query->where('fishermen_info_stats_infos.annualIncome', '>=', $request->annualIncomeStartId);
                })
                ->when(!($annualIncomeEndId[0] == 0), function ($query) use ($request) {
                    $query->where('fishermen_info_stats_infos.annualIncome', '<=', $request->annualIncomeEndId);
                })
                ->when(!($priceOfVesselStartId[0] == 0), function ($query) use ($request) {
                    $query->where('fishermen_info_stats_infos.priceOfVessels', '>=', $request->priceOfVesselStartId);
                })
                ->when(!($priceOfVesselEndId[0] == 0), function ($query) use ($request) {
                    $query->where('fishermen_info_stats_infos.priceOfVessels', '<=', $request->priceOfVesselEndId);
                });
            // deficiencyPeriodId
            //end
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('IdCard', function ($user) {
                    return '<div class="btn-group"><a href="/view-fisher-id-card/' . $user->id . '" class="edit btn btn-info btn-sm">View ID Card</a></div>';
                })
                ->addColumn('action', function ($user) {
                    return '<div class="btn-group"><a href="/view-fisher-info/' . $user->id . '" class="edit btn btn-primary btn-sm">View</a><a href="/edit-fisher-info/' . $user->id . '" class="edit btn btn-success btn-sm">Edit</a></div>';
                })
                ->rawColumns(['IdCard', 'action'])
                ->make(true);
        }
        return view('admin.reports.getAllFishersInfo');
    }

    public function getFishersMasterReportPdf(Request $request)
    {
        $startLimit = $request->startLimit;
        if($startLimit==1)
        {
            $startLimit=0;
        }
        else
        {
            $startLimit=($startLimit-1);
        }
        $endLimit= $request->endLimit;
        $limit = $endLimit-$startLimit;
        if (strlen($request->districtId) > 1) {
            $districtId = $request->districtId;
        } else {
            $districtId = '0' . $request->districtId;
        }
        if (strlen($request->upazilaId) > 1) {
            $upazilaId = $request->upazilaId;
        } else {
            $upazilaId = '0' . $request->upazilaId;
        }
        $divisionId = $request->divisionId;
        $genderId = $request->genderId;
        $religionId = $request->religionId;
        $educationId = $request->educationId;
        $maritalStatusId = $request->maritalStatusId;
        $yearlySavingId = $request->yearlySavingId;
        $yearlyLoanId = $request->yearlyLoanId;
        $deficiencyPeriodId = $request->deficiencyPeriodId;
        $fishingTimeId = $request->fishingTimeId;
        $fishingTypeId = $request->fishingTypeId;
        $placeOfFishingId = $request->placeOfFishingId;
        $ownershipNetId = $request->ownershipNetId;
        $typeOfVesselsId = $request->typeOfVesselsId;
        $ownerOfVesselsId = $request->ownerOfVesselsId;
        $fishSalePlaceId = $request->fishSalePlaceId;
        $ageStartId = $request->ageStarDate;
        $ageEndId = $request->ageEndDate;
        $annualIncomeStartId = $request->annualIncomeStartId;
        $annualIncomeEndId = $request->annualIncomeEndId;
        $priceOfVesselStartId = $request->priceOfVesselStartId;
        $priceOfVesselEndId = $request->priceOfVesselEndId;
        $typesOfFishId = $request->typesOfFishId;
        $fishingEquipmentId = $request->fishingEquipmentId;
        if ($request->ajax()) {
            $data = FishermenInfoCardPrint::select('fishermen_info_card_prints.id', 'fishermen_info_card_prints.fId','fishermen_info_card_prints.formId','fishermen_info_card_prints.fathersName','fishermen_info_card_prints.nationalIdNo', 'fishermen_info_card_prints.fishermanNameEng', 'fishermen_info_card_prints.dateOfBirth','fishermen_info_card_prints.wardId as ward','villages.villageEng as village','divisions.divisionEng as division','districts.districtEng as district','villages.villageEng as village')
                ->join('divisions', 'fishermen_info_card_prints.divisionId', '=', 'divisions.divisionId')
                ->join('districts', 'fishermen_info_card_prints.divisionId', '=', 'districts.districtId')
                ->join('villages', 'fishermen_info_card_prints.villageId', '=', 'villages.villageId')
                ->join('fishermen_info_stats_infos', 'fishermen_info_card_prints.id', '=', 'fishermen_info_stats_infos.dofId')
                ->when(isset($request->divisionId), function ($query) use ($request) {
                    $query->where('fishermen_info_card_prints.divisionId', $request->divisionId);
                })
                ->when(isset($request->districtId), function ($query) use ($districtId) {
                    $query->where('fishermen_info_card_prints.districtId', $districtId);
                })
                ->when(isset($request->upazilaId), function ($query) use ($upazilaId) {
                    $query->where('fishermen_info_card_prints.upazilaId', $upazilaId);
                })
                ->when(($genderId[0] == 'Male') || ($genderId[0] == 'Female'), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_card_prints.gender', $request->genderId);
                })
                ->when(!($religionId[0] == 0), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_stats_infos.religion', $request->religionId);
                })
                ->when(!($educationId[0] == 0), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_stats_infos.education', $request->educationId);
                })
                ->when(!($maritalStatusId[0] == 0), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_stats_infos.maritalStatus', $request->maritalStatusId);
                })
                ->when(!($yearlySavingId[0] == 0), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_stats_infos.yearlySaving', $request->yearlySavingId);
                })
                ->when(!($yearlyLoanId[0] == 0), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_stats_infos.yearlyLoan', $request->yearlyLoanId);
                })
                ->when(!($deficiencyPeriodId[0] == 0), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_stats_infos.dangerPeriodOfLiving', $request->deficiencyPeriodId);
                })
                ->when(!($fishingTimeId[0] == 0), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_stats_infos.timeOfFishing', $request->fishingTimeId);
                })
                ->when(!($fishingTypeId[0] == 0), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_stats_infos.howToFishing', $request->fishingTypeId);
                })
                ->when(!($placeOfFishingId[0] == 0), function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        foreach ($request->placeOfFishingId as $data) {
                            $q->orWhere('fishermen_info_stats_infos.placeOfFishing', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(!($typesOfFishId[0] == 0), function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        foreach ($request->typesOfFishId as $data) {
                            $q->orWhere('fishermen_info_stats_infos.typeOfFish', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(!($fishingEquipmentId[0] == 0), function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        foreach ($request->fishingEquipmentId as $data) {
                            $q->orWhere('fishermen_info_stats_infos.toolsType', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(!($ownershipNetId[0] == 0), function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        foreach ($request->ownershipNetId as $data) {
                            $q->orWhere('fishermen_info_stats_infos.ownerOfNet', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(!($typeOfVesselsId[0] == 0), function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        foreach ($request->typeOfVesselsId as $data) {
                            $q->orWhere('fishermen_info_stats_infos.typeOfVessels', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(!($ownerOfVesselsId[0] == 0), function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        foreach ($request->ownerOfVesselsId as $data) {
                            $q->orWhere('fishermen_info_stats_infos.ownerOfVessels', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(!($fishSalePlaceId[0] == 0), function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        foreach ($request->fishSalePlaceId as $data) {
                            $q->orWhere('fishermen_info_stats_infos.salePlaceOfFish', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(!($ageStartId[0] == 0), function ($query) use ($request) {
                    $query->whereDate('fishermen_info_card_prints.dateOfBirth', '<=', $request->ageStarDate);
                })
                ->when(!($ageEndId[0] == 0), function ($query) use ($request) {
                    $query->whereDate('fishermen_info_card_prints.dateOfBirth', '>=', $request->ageEndDate);
                })
                ->when(!($annualIncomeStartId[0] == 0), function ($query) use ($request) {
                    $query->where('fishermen_info_stats_infos.annualIncome', '>=', $request->annualIncomeStartId);
                })
                ->when(!($annualIncomeEndId[0] == 0), function ($query) use ($request) {
                    $query->where('fishermen_info_stats_infos.annualIncome', '<=', $request->annualIncomeEndId);
                })
                ->when(!($priceOfVesselStartId[0] == 0), function ($query) use ($request) {
                    $query->where('fishermen_info_stats_infos.priceOfVessels', '>=', $request->priceOfVesselStartId);
                })
                ->when(!($priceOfVesselEndId[0] == 0), function ($query) use ($request) {
                    $query->where('fishermen_info_stats_infos.priceOfVessels', '<=', $request->priceOfVesselEndId);
                })
                ->skip($startLimit)
                ->limit($limit)
                ->get()
                ->toArray();

                $fileName = 'fisher-man-list-by-birth.pdf';
                $mPdf = new \Mpdf\Mpdf([
                    'margin_left' => 10,
                    'margin_right' => 10,
                    'margin_top' => 15,
                    'margin_bottom' => 20,
                    'margin_header' => 10,
                    'margin_footer' => 10,
                    'default_font' => 'nikosh',
                    'default_font_size' => 14
                ]);
                $html = \View::make('admin.id-card.getFishersListonMasterReport',['fisherList' => $data]);
                $html = $html->render();
                $mPdf->WriteHTML($html);
                $mPdf->Output($fileName, 'I');
        }
    }

    public function getFishersIdCardfromMasterReport(Request $request)
    {
        $startLimit = $request->startLimit;
        if($startLimit==1)
        {
            $startLimit=0;
        }
        else
        {
            $startLimit=($startLimit-1);
        }
        
        $endLimit= $request->endLimit;
        $limit = $endLimit-$startLimit;
        
        if (strlen($request->districtId) > 1) {
            $districtId = $request->districtId;
        } else {
            $districtId = '0' . $request->districtId;
        }
        if (strlen($request->upazilaId) > 1) {
            $upazilaId = $request->upazilaId;
        } else {
            $upazilaId = '0' . $request->upazilaId;
        }
        $divisionId = $request->divisionId;
        $genderId = $request->genderId;

        $religionId = $request->religionId;
        $educationId = $request->educationId;
        $maritalStatusId = $request->maritalStatusId;
        $yearlySavingId = $request->yearlySavingId;
        $yearlyLoanId = $request->yearlyLoanId;

        $deficiencyPeriodId = $request->deficiencyPeriodId;
        $fishingTimeId = $request->fishingTimeId;
        $fishingTypeId = $request->fishingTypeId;
        $placeOfFishingId = $request->placeOfFishingId;
        $ownershipNetId = $request->ownershipNetId;
        $typeOfVesselsId = $request->typeOfVesselsId;
        $ownerOfVesselsId = $request->ownerOfVesselsId;
        $fishSalePlaceId = $request->fishSalePlaceId;
        $ageStartId = $request->ageStarDate;
        $ageEndId = $request->ageEndDate;
        $annualIncomeStartId = $request->annualIncomeStartId;
        $annualIncomeEndId = $request->annualIncomeEndId;
        $priceOfVesselStartId = $request->priceOfVesselStartId;
        $priceOfVesselEndId = $request->priceOfVesselEndId;
        $typesOfFishId = $request->typesOfFishId;
        $fishingEquipmentId = $request->fishingEquipmentId;

        if ($request->ajax()) {
            $data = FishermenInfoCardPrint::select('fishermen_info_card_prints.id', 'fishermen_info_card_prints.fId','fishermen_info_card_prints.formId','fishermen_info_card_prints.gender','fishermen_info_card_prints.fathersName','fishermen_info_card_prints.nationalIdNo', 'fishermen_info_card_prints.fishermanNameEng', 'fishermen_info_card_prints.dateOfBirth','fishermen_info_card_prints.wardId as ward')
                ->join('divisions', 'fishermen_info_card_prints.divisionId', '=', 'divisions.divisionId')
                ->join('districts', 'fishermen_info_card_prints.divisionId', '=', 'districts.districtId')
                ->join('villages', 'fishermen_info_card_prints.villageId', '=', 'villages.villageId')
                ->join('fishermen_info_stats_infos', 'fishermen_info_card_prints.id', '=', 'fishermen_info_stats_infos.dofId')
                ->when(isset($request->divisionId), function ($query) use ($request) {
                    $query->where('fishermen_info_card_prints.divisionId', $request->divisionId);
                })
                ->when(isset($request->districtId), function ($query) use ($districtId) {
                    $query->where('fishermen_info_card_prints.districtId', $districtId);
                })
                ->when(isset($request->upazilaId), function ($query) use ($upazilaId) {
                    $query->where('fishermen_info_card_prints.upazilaId', $upazilaId);
                })
                ->when(($genderId[0] == 'Male') || ($genderId[0] == 'Female'), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_card_prints.gender', $request->genderId);
                })
                ->when(!($religionId[0] == 0), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_stats_infos.religion', $request->religionId);
                })
                ->when(!($educationId[0] == 0), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_stats_infos.education', $request->educationId);
                })
                ->when(!($maritalStatusId[0] == 0), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_stats_infos.maritalStatus', $request->maritalStatusId);
                })
                ->when(!($yearlySavingId[0] == 0), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_stats_infos.yearlySaving', $request->yearlySavingId);
                })
                ->when(!($yearlyLoanId[0] == 0), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_stats_infos.yearlyLoan', $request->yearlyLoanId);
                })
                ->when(!($deficiencyPeriodId[0] == 0), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_stats_infos.dangerPeriodOfLiving', $request->deficiencyPeriodId);
                })
                ->when(!($fishingTimeId[0] == 0), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_stats_infos.timeOfFishing', $request->fishingTimeId);
                })
                ->when(!($fishingTypeId[0] == 0), function ($query) use ($request) {
                    $query->whereIn('fishermen_info_stats_infos.howToFishing', $request->fishingTypeId);
                })
                ->when(!($placeOfFishingId[0] == 0), function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        foreach ($request->placeOfFishingId as $data) {
                            $q->orWhere('fishermen_info_stats_infos.placeOfFishing', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(!($typesOfFishId[0] == 0), function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        foreach ($request->typesOfFishId as $data) {
                            $q->orWhere('fishermen_info_stats_infos.typeOfFish', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(!($fishingEquipmentId[0] == 0), function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        foreach ($request->fishingEquipmentId as $data) {
                            $q->orWhere('fishermen_info_stats_infos.toolsType', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(!($ownershipNetId[0] == 0), function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        foreach ($request->ownershipNetId as $data) {
                            $q->orWhere('fishermen_info_stats_infos.ownerOfNet', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(!($typeOfVesselsId[0] == 0), function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        foreach ($request->typeOfVesselsId as $data) {
                            $q->orWhere('fishermen_info_stats_infos.typeOfVessels', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(!($ownerOfVesselsId[0] == 0), function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        foreach ($request->ownerOfVesselsId as $data) {
                            $q->orWhere('fishermen_info_stats_infos.ownerOfVessels', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(!($fishSalePlaceId[0] == 0), function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        foreach ($request->fishSalePlaceId as $data) {
                            $q->orWhere('fishermen_info_stats_infos.salePlaceOfFish', 'like', '%' . $data . '%');
                        }
                    });
                })
                ->when(!($ageStartId[0] == 0), function ($query) use ($request) {
                    $query->whereDate('fishermen_info_card_prints.dateOfBirth', '<=', $request->ageStarDate);
                })
                ->when(!($ageEndId[0] == 0), function ($query) use ($request) {
                    $query->whereDate('fishermen_info_card_prints.dateOfBirth', '>=', $request->ageEndDate);
                })
                ->when(!($annualIncomeStartId[0] == 0), function ($query) use ($request) {
                    $query->where('fishermen_info_stats_infos.annualIncome', '>=', $request->annualIncomeStartId);
                })
                ->when(!($annualIncomeEndId[0] == 0), function ($query) use ($request) {
                    $query->where('fishermen_info_stats_infos.annualIncome', '<=', $request->annualIncomeEndId);
                })
                ->when(!($priceOfVesselStartId[0] == 0), function ($query) use ($request) {
                    $query->where('fishermen_info_stats_infos.priceOfVessels', '>=', $request->priceOfVesselStartId);
                })
                ->when(!($priceOfVesselEndId[0] == 0), function ($query) use ($request) {
                    $query->where('fishermen_info_stats_infos.priceOfVessels', '<=', $request->priceOfVesselEndId);
                })
                ->skip($startLimit)
                ->limit($limit)
                ->get()
                ->toArray();
                 
                $fileName = 'fisher-man-list-by-birth.pdf';
                $mPdf = new \Mpdf\Mpdf([
                    'margin_left' => 10,
                    'margin_right' => 10,
                    'margin_top' => 15,
                    'margin_bottom' => 20,
                    'margin_header' => 10,
                    'margin_footer' => 10,
                    'default_font' => 'nikosh',
                    'default_font_size' => 14
                ]);
                $html = \View::make('admin.id-card.getFishersIdCardListonMasterReport',['fisherList' => $data]);
                $html = $html->render();
                $mPdf->WriteHTML($html);
                $mPdf->Output($fileName, 'I');
            
        }

    }
}
