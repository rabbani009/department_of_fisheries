<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use App\Models\Education;
use App\Models\FishCategory;
use App\Models\MaritalStatus;
use App\Models\Religion;
use App\Models\OwnerOfVessels;
use App\Models\DeficiencyPeriod;
use App\Models\FishermenInfoStatsInfo;
use App\Models\FishingPlace;
use App\Models\YearlySaving;
use App\Models\YearlyLoan;
use App\Models\FishSalePlaces;
use App\Models\Municipality;
use App\Models\TimeOfFishing;
use App\Models\Union;
use App\Models\Upazila;
use App\Repositories\FishermenInfoCardPrint\FishermenInfoCardPrintInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectReportController extends Controller
{
    private $fishermenInfoCardPrint,
        $divisionsList,
        $educationList,
        $maritalStatusList,
        $fishingTimeList,
        $fishCategoryList,
        $districtList,
        $religionList,
        $ownerOfVessels,
        $deficiencyPeriod,
        $yearlySaving,
        $yearlyLoan,
        $upazilaList,
        $placeOfFishings,
        $unionList,
        $municipalityList,
        $fishermenInfoStats,
        $fishSalePlaces,
        $fishSalePlace;

    public function __construct(
        FishermenInfoCardPrintInterface $fishermenInfoCardPrint,
        FishermenInfoStatsInfo $fishermenInfoStats,
        Division $divisionsList,
        District $districtList,
        Upazila $upazilaList,
        Union $unionList,
        Municipality $municipalityList,
        FishSalePlaces $fishSalePlaces,
        Religion $religionList,
        MaritalStatus $maritalStatusList,
        FishCategory $fishCategoryList,
        TimeOfFishing $fishingTimeList,
        Education $educationList,
        OwnerOfVessels $ownerOfVessels,
        DeficiencyPeriod $deficiencyPeriod,
        FishingPlace $placeOfFishings,
        YearlySaving $yearlySaving,
        YearlyLoan $yearlyLoan,
        FishSalePlaces $fishSalePlace
    ) {
        $this->middleware('auth');
        $this->middleware('preventBackHistory'); 
        $this->fishermenInfoCardPrint = $fishermenInfoCardPrint;
        $this->fishermenInfoStats = $fishermenInfoStats;
        $this->divisionsList = $divisionsList;
        $this->districtList = $districtList;
        $this->municipalityList = $municipalityList;
        $this->religionList = $religionList;
        $this->ownerOfVessels = $ownerOfVessels;
        $this->deficiencyPeriod = $deficiencyPeriod;
        $this->yearlySaving = $yearlySaving;
        $this->yearlyLoan = $yearlyLoan;
        $this->fishSalePlace = $fishSalePlace;
        $this->maritalStatusList = $maritalStatusList;
        $this->fishingTimeList = $fishingTimeList;
        $this->fishCategoryList = $fishCategoryList;
        $this->upazilaList = $upazilaList;
        $this->unionList = $unionList;
        $this->placeOfFishings = $placeOfFishings;
        $this->fishSalePlaces = $fishSalePlaces;
        $this->educationList = $educationList;
    }
    public function subjectWiseReport()
    {
        // return 
        $divisions = DB::table('divisions')->orderBy('divisionEng', 'ASC')->get();
        return view('admin.subject-wise-report.subject-wise-report')->with([
            'divisions' => $divisions
        ]);
    }
    public function getSubjectWiseReport(Request $request)
    {
        $subjectTopic = $request->topic;
        $subjectDivision = $request->divisionId;
        $subjectDistrict = $request->districtId;
        $subjectUpazila = $request->upazilaId;
        // gender wise data
        if (($subjectTopic == 'gender_wise') & empty($subjectDivision) & empty($subjectDistrict) & empty($subjectUpazila)) {
            $divisions =  $this->divisionsList->getDivisionList();
            $data = cache()->remember('getGenderWiseData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_gender_wise_data()');
            });
            return view('admin.subject-wise-report.show-gender-wise-report')->with([
                'divisions' => $divisions,
                'subjectTopic' => $subjectTopic,
                'data' => $data,
            ])->render();
        }
        // gender wise division data
        if (($subjectTopic == 'gender_wise') & !empty($subjectDivision) & empty($subjectDistrict) & empty($subjectUpazila)) {
            $district =  $this->districtList->getReportDistrict($subjectDivision);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $data = cache()->remember('getGenderWiseDivisionData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_gender_wise_division_data()');
            });
            return view('admin.subject-wise-report.show-gender-wise-division-report')->with([
                'subjectTopic' => $subjectTopic,
                'divisionName' => $divisionName,
                'district' => $district,
                'data' => $data,
            ])->render();
        }
        // gender wise district data
        if (($subjectTopic == 'gender_wise') & !empty($subjectDivision) & !empty($subjectDistrict) & empty($subjectUpazila)) {
            $upazila =  $this->upazilaList->getReportUpazila($subjectDivision, $subjectDistrict);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $districtName =  $this->districtList->getReportDistrictName($subjectDistrict);
            // return $district;
            $data = cache()->remember('getGenderWiseDistrictAndUpazilaData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_gender_wise_district_and_upazila_data()');
            });
            return view('admin.subject-wise-report.show-gender-wise-district-report')->with([
                'subjectTopic' => $subjectTopic,
                'divisionName' => $divisionName,
                'districtName' => $districtName,
                'upazila' => $upazila,
                'data' => $data,
            ])->render();
        }
        // gender wise upazila data
        if (($subjectTopic == 'gender_wise') & !empty($subjectDivision) & !empty($subjectDistrict) & !empty($subjectUpazila)) {
            $unionGet =  $this->unionList->getReportUnion($subjectDivision, $subjectDistrict, $subjectUpazila);
            $municipality =  $this->municipalityList->getReportMunicipality($subjectDivision, $subjectDistrict, $subjectUpazila);
            $union = $unionGet->merge($municipality);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $districtName =  $this->districtList->getReportDistrictName($subjectDistrict);
            $upazilaName =  $this->upazilaList->getReportUpazilaName($subjectDivision, $subjectDistrict, $subjectUpazila);

            $data = cache()->remember('getGenderWiseUnionData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_gender_wise_union_data()');
            });
            return view('admin.subject-wise-report.show-gender-wise-upazila-report')->with([
                'subjectTopic' => $subjectTopic,
                'divisionName' => $divisionName,
                'districtName' => $districtName,
                'upazilaName' => $upazilaName,
                'union' => $union,
                'data' => $data,
            ])->render();
        }
        // number wise data
        if (($subjectTopic == 'number_wise') & empty($subjectDivision) & empty($subjectDistrict) & empty($subjectUpazila)) {
            $divisions =  $this->divisionsList->getDivisionList();
            $data = cache()->remember('getNumberWiseData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_number_wise_data()');
            });
            // $data= $this->fishermenInfoCardPrint->subjectBasedReport($subjectTopic);
            return view('admin.subject-wise-report.show-number-wise-report')->with([
                'subjectTopic' => $subjectTopic,
                'divisions' => $divisions,
                'data' => $data,
            ]);
        }
        // number wise division data
        if (($subjectTopic == 'number_wise') & !empty($subjectDivision) & empty($subjectDistrict) & empty($subjectUpazila)) {
            $district =  $this->districtList->getReportDistrict($subjectDivision);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $data = cache()->remember('getNumberWiseDivisionData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_number_wise_division_data()');
            });
            return view('admin.subject-wise-report.show-number-wise-division-report')->with([
                'subjectTopic' => $subjectTopic,
                'divisionName' => $divisionName,
                'district' => $district,
                'data' => $data,
            ]);
        }
        // number wise district data
        if (($subjectTopic == 'number_wise') & !empty($subjectDivision) & !empty($subjectDistrict) & empty($subjectUpazila)) {
            $upazila =  $this->upazilaList->getReportUpazila($subjectDivision, $subjectDistrict);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $districtName =  $this->districtList->getReportDistrictName($subjectDistrict);
            $data = cache()->remember('getNumberWiseDistrictData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_number_wise_district_data()');
            });
            return view('admin.subject-wise-report.show-number-wise-district-report')->with([
                'subjectTopic' => $subjectTopic,
                'divisionName' => $divisionName,
                'districtName' => $districtName,
                'upazila' => $upazila,
                'data' => $data,
            ]);
        }
        // number wise upazila data
        if (($subjectTopic == 'number_wise') & !empty($subjectDivision) & !empty($subjectDistrict) & !empty($subjectUpazila)) {
            $unionGet =  $this->unionList->getReportUnion($subjectDivision, $subjectDistrict, $subjectUpazila);
            $municipality =  $this->municipalityList->getReportMunicipality($subjectDivision, $subjectDistrict, $subjectUpazila);
            $union = $unionGet->merge($municipality);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $districtName =  $this->districtList->getReportDistrictName($subjectDistrict);
            $upazilaName =  $this->upazilaList->getReportUpazilaName($subjectDivision, $subjectDistrict, $subjectUpazila);
            $data = cache()->remember('getNumberWiseUpazilaData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_number_wise_upazila_data()');
            });
            return view('admin.subject-wise-report.show-number-wise-upazila-report')->with([
                'subjectTopic' => $subjectTopic,
                'divisionName' => $divisionName,
                'districtName' => $districtName,
                'upazilaName' => $upazilaName,
                'union' => $union,
                'data' => $data,
            ]);
        }
        // religion wise data
        if (($subjectTopic == 'religion_wise') & empty($subjectDivision) & empty($subjectDistrict) & empty($subjectUpazila)) {
            $divisions =  $this->divisionsList->getDivisionList();
            $religion =  $this->religionList->getReligionList();
            $data = cache()->remember('getReligionWiseData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_religion_wise_data()');
            });
            return view('admin.subject-wise-report.show-religion-wise-report')->with([
                'divisions' => $divisions,
                'religion' => $religion,
                'subjectTopic' => $subjectTopic,
                'data' => $data,
            ]);
        }
        // religion wise division data
        if (($subjectTopic == 'religion_wise') & !empty($subjectDivision) & empty($subjectDistrict) & empty($subjectUpazila)) {
            $district =  $this->districtList->getReportDistrict($subjectDivision);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $religion =  $this->religionList->getReligionList();
            $data = cache()->remember('getReligionWiseDivisionData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_religion_wise_division_data()');
            });
            return view('admin.subject-wise-report.show-religion-wise-division-report')->with([
                'divisionName' => $divisionName,
                'district' => $district,
                'religion' => $religion,
                'subjectTopic' => $subjectTopic,
                'data' => $data,
            ]);
        }
        // religion wise district data
        if (($subjectTopic == 'religion_wise') & !empty($subjectDivision) & !empty($subjectDistrict) & empty($subjectUpazila)) {
            $upazila =  $this->upazilaList->getReportUpazila($subjectDivision, $subjectDistrict);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $districtName =  $this->districtList->getReportDistrictName($subjectDistrict);
            $religion =  $this->religionList->getReligionList();
            $data = cache()->remember('getReligionWiseDistrictData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_religion_wise_district_data()');
            });
            return view('admin.subject-wise-report.show-religion-wise-district-report')->with([
                'divisionName' => $divisionName,
                'districtName' => $districtName,
                'upazila' => $upazila,
                'religion' => $religion,
                'subjectTopic' => $subjectTopic,
                'data' => $data,
            ]);
        }
        // religion wise upazila data
        if (($subjectTopic == 'religion_wise') & !empty($subjectDivision) & !empty($subjectDistrict) & !empty($subjectUpazila)) {
            $unionGet =  $this->unionList->getReportUnion($subjectDivision, $subjectDistrict, $subjectUpazila);
            $municipality =  $this->municipalityList->getReportMunicipality($subjectDivision, $subjectDistrict, $subjectUpazila);
            $union = $unionGet->merge($municipality);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $districtName =  $this->districtList->getReportDistrictName($subjectDistrict);
            $upazilaName =  $this->upazilaList->getReportUpazilaName($subjectDivision, $subjectDistrict, $subjectUpazila);
            $religion =  $this->religionList->getReligionList();
            $data = cache()->remember('getReligionWiseUpazilaData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_religion_wise_upazila_data()');
            });
            return view('admin.subject-wise-report.show-religion-wise-upazila-report')->with([
                'divisionName' => $divisionName,
                'districtName' => $districtName,
                'upazilaName' => $upazilaName,
                'union' => $union,
                'subjectTopic' => $subjectTopic,
                'religion' => $religion,
                'data' => $data,
            ]);
        }
        //owner_of_vessels
        if (($subjectTopic == 'owner_of_vessels')  & empty($subjectDivision) & empty($subjectDistrict) & empty($subjectUpazila)) {
            $divisions =  $this->divisionsList->getDivisionList();
            $ownerOfVessels = $this->ownerOfVessels->getOwnerOfVessels();
            $data = cache()->remember('getOwnerofVesselsData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_owner_of_vesseles_wise_data()');
            });
            return view('admin.subject-wise-report.get-owner-of-vessels-wise-report')->with([
                'divisions' => $divisions,
                'subjectTopic' => $subjectTopic,
                'ownerOfVessels' => $ownerOfVessels,
                'data' => $data,
            ]);
        }
        //owner_of_vessels division data
        if (($subjectTopic == 'owner_of_vessels')  & !empty($subjectDivision) & empty($subjectDistrict) & empty($subjectUpazila)) {
            $district =  $this->districtList->getReportDistrict($subjectDivision);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $ownerOfVessels = $this->ownerOfVessels->getOwnerOfVessels();
            $data = cache()->remember('getOwnerofVesselsDivisionData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_owner_of_vesseles_wise_division_data()');
            });
            return view('admin.subject-wise-report.get-owner-of-vessels-wise-division-report')->with([
                'district' => $district,
                'divisionName' => $divisionName,
                'subjectTopic' => $subjectTopic,
                'ownerOfVessels' => $ownerOfVessels,
                'data' => $data,
            ]);
        }
        //owner_of_vessels district data
        if (($subjectTopic == 'owner_of_vessels')  & !empty($subjectDivision) & !empty($subjectDistrict) & empty($subjectUpazila)) {
            $upazila =  $this->upazilaList->getReportUpazila($subjectDivision, $subjectDistrict);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $districtName =  $this->districtList->getReportDistrictName($subjectDistrict);
            $ownerOfVessels = $this->ownerOfVessels->getOwnerOfVessels();
            $data = cache()->remember('getOwnerofVesselsDistrictData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_owner_of_vessels_wise_district_data()');
            });
            return view('admin.subject-wise-report.get-owner-of-vessels-wise-district-report')->with([
                'divisionName' => $divisionName,
                'districtName' => $districtName,
                'upazila' => $upazila,
                'subjectTopic' => $subjectTopic,
                'ownerOfVessels' => $ownerOfVessels,
                'data' => $data,
            ]);
        }
        //owner_of_vessels upazila data
        if (($subjectTopic == 'owner_of_vessels')  & !empty($subjectDivision) & !empty($subjectDistrict) & !empty($subjectUpazila)) {
            $unionGet =  $this->unionList->getReportUnion($subjectDivision, $subjectDistrict, $subjectUpazila);
            $municipality =  $this->municipalityList->getReportMunicipality($subjectDivision, $subjectDistrict, $subjectUpazila);
            $union = $unionGet->merge($municipality);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $districtName =  $this->districtList->getReportDistrictName($subjectDistrict);
            $upazilaName =  $this->upazilaList->getReportUpazilaName($subjectDivision, $subjectDistrict, $subjectUpazila);
            $ownerOfVessels = $this->ownerOfVessels->getOwnerOfVessels();
            $data = cache()->remember('getOwnerofVesselsUpazilaData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_owner_of_vessels_wise_upazila_data()');
            });
            return view('admin.subject-wise-report.get-owner-of-vessels-wise-upazila-report')->with([
                'divisionName' => $divisionName,
                'districtName' => $districtName,
                'upazilaName' => $upazilaName,
                'union' => $union,
                'subjectTopic' => $subjectTopic,
                'ownerOfVessels' => $ownerOfVessels,
                'data' => $data,
            ]);
        }

        //crysis_period_wise
        if (($subjectTopic == 'crysis_period_wise') & empty($subjectDivision) & empty($subjectDistrict) & empty($subjectUpazila)) {
            $divisions =  $this->divisionsList->getDivisionList();
            $deficiencyPeriod = $this->deficiencyPeriod->getDeficiencyPeriod();
            $data = cache()->remember('getCrisisPeriodWiseData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_deficiency_period_wise_data()');
            });
            return view('admin.subject-wise-report.get-deficiency-period-wise-report')->with([
                'divisions' => $divisions,
                'subjectTopic' => $subjectTopic,
                'deficiencyPeriod' => $deficiencyPeriod,
                'data' => $data,
            ]);
        }
        //crysis_period_wise division data
        if (($subjectTopic == 'crysis_period_wise') & !empty($subjectDivision) & empty($subjectDistrict) & empty($subjectUpazila)) {
            $district =  $this->districtList->getReportDistrict($subjectDivision);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $deficiencyPeriod = $this->deficiencyPeriod->getDeficiencyPeriod();
            $data = cache()->remember('getCrisisPeriodWiseDivisionData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_deficiency_period_wise_division_data()');
            });
            return view('admin.subject-wise-report.get-deficiency-period-wise-division-report')->with([
                'district' => $district,
                'divisionName' => $divisionName,
                'subjectTopic' => $subjectTopic,
                'deficiencyPeriod' => $deficiencyPeriod,
                'data' => $data,
            ]);
        }
        //crysis_period_wise district data
        if (($subjectTopic == 'crysis_period_wise') & !empty($subjectDivision) & !empty($subjectDistrict) & empty($subjectUpazila)) {
            $upazila =  $this->upazilaList->getReportUpazila($subjectDivision, $subjectDistrict);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $districtName =  $this->districtList->getReportDistrictName($subjectDistrict);
            $deficiencyPeriod = $this->deficiencyPeriod->getDeficiencyPeriod();
            $data = cache()->remember('getCrisisPeriodWiseDistrictData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_deficiency_period_wise_district_data()');
            });
            return view('admin.subject-wise-report.get-deficiency-period-wise-district-report')->with([
                'divisionName' => $divisionName,
                'districtName' => $districtName,
                'upazila' => $upazila,
                'subjectTopic' => $subjectTopic,
                'deficiencyPeriod' => $deficiencyPeriod,
                'data' => $data,
            ]);
        }
        //crysis_period_wise upazila data
        if (($subjectTopic == 'crysis_period_wise') & !empty($subjectDivision) & !empty($subjectDistrict) & !empty($subjectUpazila)) {
            $unionGet =  $this->unionList->getReportUnion($subjectDivision, $subjectDistrict, $subjectUpazila);
            $municipality =  $this->municipalityList->getReportMunicipality($subjectDivision, $subjectDistrict, $subjectUpazila);
            $union = $unionGet->merge($municipality);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $districtName =  $this->districtList->getReportDistrictName($subjectDistrict);
            $upazilaName =  $this->upazilaList->getReportUpazilaName($subjectDivision, $subjectDistrict, $subjectUpazila);
            $deficiencyPeriod = $this->deficiencyPeriod->getDeficiencyPeriod();
            $data = cache()->remember('getCrisisPeriodWiseUpazilaData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_deficiency_period_wise_upazila_data()');
            });
            return view('admin.subject-wise-report.get-deficiency-period-wise-upazila-report')->with([
                'divisionName' => $divisionName,
                'districtName' => $districtName,
                'upazilaName' => $upazilaName,
                'union' => $union,
                'subjectTopic' => $subjectTopic,
                'deficiencyPeriod' => $deficiencyPeriod,
                'data' => $data,
            ]);
        }
        //yearly_savings_wise
        if (($subjectTopic == 'yearly_savings_wise') & empty($subjectDivision) & empty($subjectDistrict) & empty($subjectUpazila)) {
            $divisions =  $this->divisionsList->getDivisionList();
            $yearlySaving = $this->yearlySaving->getYearlySaving();
            $data = cache()->remember('getYearlySavingWiseData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_yearly_saving_wise_data()');
            });
            return view('admin.subject-wise-report.get-yearlysaving-wise-report')->with([
                'divisions' => $divisions,
                'subjectTopic' => $subjectTopic,
                'yearlySaving' => $yearlySaving,
                'data' => $data,
            ]);
        }
        //yearly_savings_wise division data
        if (($subjectTopic == 'yearly_savings_wise') & !empty($subjectDivision) & empty($subjectDistrict) & empty($subjectUpazila)) {
            $district =  $this->districtList->getReportDistrict($subjectDivision);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $yearlySaving = $this->yearlySaving->getYearlySaving();
            $data = cache()->remember('getYearlySavingWiseDivisionData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_yearly_saving_wise_division_data()');
            });
            return view('admin.subject-wise-report.get-yearlysaving-wise-division-report')->with([
                'district' => $district,
                'divisionName' => $divisionName,
                'subjectTopic' => $subjectTopic,
                'yearlySaving' => $yearlySaving,
                'data' => $data,
            ]);
        }
        //yearly_savings_wise district data
        if (($subjectTopic == 'yearly_savings_wise') & !empty($subjectDivision) & !empty($subjectDistrict) & empty($subjectUpazila)) {
            $upazila =  $this->upazilaList->getReportUpazila($subjectDivision, $subjectDistrict);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $districtName =  $this->districtList->getReportDistrictName($subjectDistrict);
            $yearlySaving = $this->yearlySaving->getYearlySaving();
            $data = cache()->remember('getYearlySavingWiseDistrictData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_yearly_saving_wise_district_data()');
            });
            return view('admin.subject-wise-report.get-yearlysaving-wise-district-report')->with([
                'divisionName' => $divisionName,
                'districtName' => $districtName,
                'upazila' => $upazila,
                'subjectTopic' => $subjectTopic,
                'yearlySaving' => $yearlySaving,
                'data' => $data,
            ]);
        }
        //yearly_savings_wise upazila data
        if (($subjectTopic == 'yearly_savings_wise') & !empty($subjectDivision) & !empty($subjectDistrict) & !empty($subjectUpazila)) {
            $unionGet =  $this->unionList->getReportUnion($subjectDivision, $subjectDistrict, $subjectUpazila);
            $municipality =  $this->municipalityList->getReportMunicipality($subjectDivision, $subjectDistrict, $subjectUpazila);
            $union = $unionGet->merge($municipality);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $districtName =  $this->districtList->getReportDistrictName($subjectDistrict);
            $upazilaName =  $this->upazilaList->getReportUpazilaName($subjectDivision, $subjectDistrict, $subjectUpazila);
            $yearlySaving = $this->yearlySaving->getYearlySaving();
            $data = cache()->remember('getYearlySavingWiseUpazilaData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_yearly_saving_wise_upazila_data()');
            });
            return view('admin.subject-wise-report.get-yearlysaving-wise-upazila-report')->with([
                'divisionName' => $divisionName,
                'districtName' => $districtName,
                'upazilaName' => $upazilaName,
                'union' => $union,
                'subjectTopic' => $subjectTopic,
                'yearlySaving' => $yearlySaving,
                'data' => $data,
            ]);
        }
        //yearly loan wise
        if (($subjectTopic == 'yearly_loan_wise') & empty($subjectDivision) & empty($subjectDistrict) & empty($subjectUpazila)) {
            $divisions =  $this->divisionsList->getDivisionList();
            $yearlyLoan = $this->yearlyLoan->getYearlyLoan();
            $data = cache()->remember('getYearlyLoanWiseData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_yearly_loan_wise_data()');
            });
            return view('admin.subject-wise-report.get-yearlyloan-wise-report')->with([
                'divisions' => $divisions,
                'subjectTopic' => $subjectTopic,
                'yearlyLoan' => $yearlyLoan,
                'data' => $data,
            ]);
        }
        //yearly loan wise division data
        if (($subjectTopic == 'yearly_loan_wise') & !empty($subjectDivision) & empty($subjectDistrict) & empty($subjectUpazila)) {
            $district =  $this->districtList->getReportDistrict($subjectDivision);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $yearlyLoan = $this->yearlyLoan->getYearlyLoan();
            $data = cache()->remember('getYearlyLoanWiseDivisionData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_yearly_loan_wise_division_data()');
            });
            return view('admin.subject-wise-report.get-yearlyloan-wise-division-report')->with([
                'district' => $district,
                'divisionName' => $divisionName,
                'subjectTopic' => $subjectTopic,
                'yearlyLoan' => $yearlyLoan,
                'data' => $data,
            ]);
        }
        //yearly loan wise district data
        if (($subjectTopic == 'yearly_loan_wise') & !empty($subjectDivision) & !empty($subjectDistrict) & empty($subjectUpazila)) {
            $upazila =  $this->upazilaList->getReportUpazila($subjectDivision, $subjectDistrict);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $districtName =  $this->districtList->getReportDistrictName($subjectDistrict);
            $yearlyLoan = $this->yearlyLoan->getYearlyLoan();
            $data = cache()->remember('getYearlyLoanWiseDistrictData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_yearly_loan_wise_district_data()');
            });
            return view('admin.subject-wise-report.get-yearlyloan-wise-district-report')->with([
                'divisionName' => $divisionName,
                'districtName' => $districtName,
                'upazila' => $upazila,
                'subjectTopic' => $subjectTopic,
                'yearlyLoan' => $yearlyLoan,
                'data' => $data,
            ]);
        }
        //yearly loan wise upazila data
        if (($subjectTopic == 'yearly_loan_wise') & !empty($subjectDivision) & !empty($subjectDistrict) & !empty($subjectUpazila)) {
            $unionGet =  $this->unionList->getReportUnion($subjectDivision, $subjectDistrict, $subjectUpazila);
            $municipality =  $this->municipalityList->getReportMunicipality($subjectDivision, $subjectDistrict, $subjectUpazila);
            $union = $unionGet->merge($municipality);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $districtName =  $this->districtList->getReportDistrictName($subjectDistrict);
            $upazilaName =  $this->upazilaList->getReportUpazilaName($subjectDivision, $subjectDistrict, $subjectUpazila);
            $yearlyLoan = $this->yearlyLoan->getYearlyLoan();
            $data = cache()->remember('getYearlyLoanWiseUpazilaData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_yearly_loan_wise_upazila_data()');
            });
            return view('admin.subject-wise-report.get-yearlyloan-wise-upazila-report')->with([
                'divisionName' => $divisionName,
                'districtName' => $districtName,
                'upazilaName' => $upazilaName,
                'union' => $union,
                'subjectTopic' => $subjectTopic,
                'yearlyLoan' => $yearlyLoan,
                'data' => $data,
            ]);
        }
        // //fishing sale place
        // if (($subjectTopic == 'sale_place_wise') & empty($subjectDivision)) {
        //     $divisions =  $this->divisionsList->getDivisionList();
        //     $fishSalePlace = $this->fishSalePlace->getFishSalePlaces();

        //     $data = cache()->remember('getFishSalingPlaceData', 60 * 60 * 24, function () {
        //         return $data = DB::select('CALL get_yearly_loan_wise_data()');
        //     });
        //     return view('admin.subject-wise-report.get-yearlyloan-wise-report')->with([
        //         'divisions' => $divisions,
        //         'subjectTopic' => $subjectTopic,
        //         'fishSalePlace' => $fishSalePlace,
        //         'data' => $data,
        //     ]);
        // }
        // //fishing sale place division data
        // if (($subjectTopic == 'sale_place_wise') & !empty($subjectDivision)) {
        //     $district =  $this->districtList->getReportDistrict($subjectDivision);
        //     $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
        //     $fishSalePlace = $this->fishSalePlace->getFishSalePlaces();
        //     $data = cache()->remember('getFishSalingPlaceData', 60 * 60 * 24, function () {
        //         return $data = DB::select('CALL get_yearly_loan_wise_data()');
        //     });
        //     return view('admin.subject-wise-report.get-yearlyloan-wise-division-report')->with([
        //         'district' => $district,
        //         'divisionName' => $divisionName,
        //         'subjectTopic' => $subjectTopic,
        //         'fishSalePlace' => $fishSalePlace,
        //         'data' => $data,
        //     ]);
        // }
        // education wise data
        if (($subjectTopic == 'education_wise')  & empty($subjectDivision) & empty($subjectDistrict) & empty($subjectUpazila)) {
            $divisions =  $this->divisionsList->getDivisionList();
            $education =  $this->educationList->getEducationList();
            $data = cache()->remember('getEducationWiseData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_education_wise_data()');
            });
            return view('admin.subject-wise-report.show-education-wise-report')->with([
                'divisions' => $divisions,
                'subjectTopic' => $subjectTopic,
                'education' => $education,
                'data' => $data,
            ]);
        }
        // education wise division data
        if (($subjectTopic == 'education_wise')  & !empty($subjectDivision) & empty($subjectDistrict) & empty($subjectUpazila)) {
            $district =  $this->districtList->getReportDistrict($subjectDivision);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $education =  $this->educationList->getEducationList();
            $data = cache()->remember('getEducationWiseDivisionData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_education_wise_division_data()');
            });
            return view('admin.subject-wise-report.show-education-wise-division-report')->with([
                'district' => $district,
                'divisionName' => $divisionName,
                'subjectTopic' => $subjectTopic,
                'education' => $education,
                'data' => $data,
            ]);
        }
        // education wise district data
        if (($subjectTopic == 'education_wise') & !empty($subjectDivision) & !empty($subjectDistrict) & empty($subjectUpazila)) {
            $upazila =  $this->upazilaList->getReportUpazila($subjectDivision, $subjectDistrict);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $districtName =  $this->districtList->getReportDistrictName($subjectDistrict);
            $education =  $this->educationList->getEducationList();
            $data = cache()->remember('getEducationWiseDistrictData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_education_wise_district_data()');
            });
            return view('admin.subject-wise-report.show-education-wise-district-report')->with([
                'divisionName' => $divisionName,
                'districtName' => $districtName,
                'upazila' => $upazila,
                'subjectTopic' => $subjectTopic,
                'education' => $education,
                'data' => $data,
            ]);
        }
        // education wise upazila data
        if (($subjectTopic == 'education_wise') & !empty($subjectDivision) & !empty($subjectDistrict) & !empty($subjectUpazila)) {
            $unionGet =  $this->unionList->getReportUnion($subjectDivision, $subjectDistrict, $subjectUpazila);
            $municipality =  $this->municipalityList->getReportMunicipality($subjectDivision, $subjectDistrict, $subjectUpazila);
            $union = $unionGet->merge($municipality);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $districtName =  $this->districtList->getReportDistrictName($subjectDistrict);
            $upazilaName =  $this->upazilaList->getReportUpazilaName($subjectDivision, $subjectDistrict, $subjectUpazila);
            $education =  $this->educationList->getEducationList();
            $data = cache()->remember('getEducationWiseUpazilaData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_education_wise_upazila_data()');
            });
            return view('admin.subject-wise-report.show-education-wise-upazila-report')->with([
                'divisionName' => $divisionName,
                'districtName' => $districtName,
                'upazilaName' => $upazilaName,
                'union' => $union,
                'subjectTopic' => $subjectTopic,
                'education' => $education,
                'data' => $data,
            ]);
        }
        // marital status wise data
        if (($subjectTopic == 'marital_status_wise')  & empty($subjectDivision) & empty($subjectDistrict) & empty($subjectUpazila)) {
            $divisions =  $this->divisionsList->getDivisionList();
            $item =  $this->maritalStatusList->getMaritalStatusList();
            $data = cache()->remember('getMaritalStatusWiseData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_marital_status_wise_data()');
            });
            return view('admin.subject-wise-report.show-marital-status-wise-report')->with([
                'divisions' => $divisions,
                'subjectTopic' => $subjectTopic,
                'itemData' => $item,
                'data' => $data,
            ]);
        }
        // marital status wise division data
        if (($subjectTopic == 'marital_status_wise')  & !empty($subjectDivision) & empty($subjectDistrict) & empty($subjectUpazila)) {
            $district =  $this->districtList->getReportDistrict($subjectDivision);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $item =  $this->maritalStatusList->getMaritalStatusList();
            $data = cache()->remember('getMaritalStatusWiseDivisionData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_marital_status_wise_division_data()');
            });
            return view('admin.subject-wise-report.show-marital-status-wise-division-report')->with([
                'district' => $district,
                'divisionName' => $divisionName,
                'subjectTopic' => $subjectTopic,
                'itemData' => $item,
                'data' => $data,
            ]);
        }
        // marital status wise district data
        if (($subjectTopic == 'marital_status_wise')  & !empty($subjectDivision) & !empty($subjectDistrict) & empty($subjectUpazila)) {
            $upazila =  $this->upazilaList->getReportUpazila($subjectDivision, $subjectDistrict);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $districtName =  $this->districtList->getReportDistrictName($subjectDistrict);
            $item =  $this->maritalStatusList->getMaritalStatusList();
            $data = cache()->remember('getMaritalStatusWiseDistrictData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_marital_status_wise_district_data()');
            });
            return view('admin.subject-wise-report.show-marital-status-wise-district-report')->with([
                'divisionName' => $divisionName,
                'districtName' => $districtName,
                'upazila' => $upazila,
                'subjectTopic' => $subjectTopic,
                'itemData' => $item,
                'data' => $data,
            ]);
        }
        // marital status wise upazila data
        if (($subjectTopic == 'marital_status_wise')  & !empty($subjectDivision) & !empty($subjectDistrict) & !empty($subjectUpazila)) {
            $unionGet =  $this->unionList->getReportUnion($subjectDivision, $subjectDistrict, $subjectUpazila);
            $municipality =  $this->municipalityList->getReportMunicipality($subjectDivision, $subjectDistrict, $subjectUpazila);
            $union = $unionGet->merge($municipality);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $districtName =  $this->districtList->getReportDistrictName($subjectDistrict);
            $upazilaName =  $this->upazilaList->getReportUpazilaName($subjectDivision, $subjectDistrict, $subjectUpazila);
            $maritalStatusData =  $this->maritalStatusList->getMaritalStatusList();
            $data = cache()->remember('getMaritalStatusWiseUpazilaData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_marital_status_wise_upazila_data()');
            });
            return view('admin.subject-wise-report.show-marital-status-wise-upazila-report')->with([
                'divisionName' => $divisionName,
                'districtName' => $districtName,
                'upazilaName' => $upazilaName,
                'union' => $union,
                'subjectTopic' => $subjectTopic,
                'maritalStatusData' => $maritalStatusData,
                'data' => $data,
            ]);
        }
        // fishing time wise data
        if (($subjectTopic == 'fishing_time_wise')   & empty($subjectDivision) & empty($subjectDistrict) & empty($subjectUpazila)) {
            $divisions =  $this->divisionsList->getDivisionList();
            $item =  $this->fishingTimeList->getTimeOfFishings();
            $data = cache()->remember('getFishingTimeWiseData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_fishing_time_wise_data()');
            });
            return view('admin.subject-wise-report.show-fishing-time-wise-report')->with([
                'divisions' => $divisions,
                'subjectTopic' => $subjectTopic,
                'itemData' => $item,
                'data' => $data,
            ]);
        }
        // fishing time wise division data
        if (($subjectTopic == 'fishing_time_wise')   & !empty($subjectDivision) & empty($subjectDistrict) & empty($subjectUpazila)) {
            $district =  $this->districtList->getReportDistrict($subjectDivision);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $item =  $this->fishingTimeList->getTimeOfFishings();
            $data = cache()->remember('getFishingTimeWiseDivisionData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_fishing_time_wise_division_data()');
            });
            return view('admin.subject-wise-report.show-fishing-time-wise-division-report')->with([
                'district' => $district,
                'divisionName' => $divisionName,
                'subjectTopic' => $subjectTopic,
                'itemData' => $item,
                'data' => $data,
            ]);
        }
        // fishing time wise district data
        if (($subjectTopic == 'fishing_time_wise')   & !empty($subjectDivision) & !empty($subjectDistrict) & empty($subjectUpazila)) {
            $upazila =  $this->upazilaList->getReportUpazila($subjectDivision, $subjectDistrict);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $districtName =  $this->districtList->getReportDistrictName($subjectDistrict);
            $item =  $this->fishingTimeList->getTimeOfFishings();
            $data = cache()->remember('getFishingTimeWiseDistrictData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_fishing_time_wise_district_data()');
            });
            return view('admin.subject-wise-report.show-fishing-time-wise-district-report')->with([
                'divisionName' => $divisionName,
                'districtName' => $districtName,
                'upazila' => $upazila,
                'subjectTopic' => $subjectTopic,
                'itemData' => $item,
                'data' => $data,
            ]);
        }
        // fishing time wise upazila data
        if (($subjectTopic == 'fishing_time_wise')  & !empty($subjectDivision) & !empty($subjectDistrict) & !empty($subjectUpazila)) {
            $unionGet =  $this->unionList->getReportUnion($subjectDivision, $subjectDistrict, $subjectUpazila);
            $municipality =  $this->municipalityList->getReportMunicipality($subjectDivision, $subjectDistrict, $subjectUpazila);
            $union = $unionGet->merge($municipality);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $districtName =  $this->districtList->getReportDistrictName($subjectDistrict);
            $upazilaName =  $this->upazilaList->getReportUpazilaName($subjectDivision, $subjectDistrict, $subjectUpazila);
            $item =  $this->fishingTimeList->getTimeOfFishings();
            $data = cache()->remember('getFishingTimeWiseUpazilaData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_fishing_time_wise_upazila_data()');
            });
            return view('admin.subject-wise-report.show-fishing-time-wise-upazila-report')->with([
                'divisionName' => $divisionName,
                'districtName' => $districtName,
                'upazilaName' => $upazilaName,
                'union' => $union,
                'subjectTopic' => $subjectTopic,
                'itemData' => $item,
                'data' => $data,
            ]);
        }
        // fish category wise data
        // if (($subjectTopic == 'fish_type_wise')) {
        //     $divisions =  $this->divisionsList->getDivisionList();
        //     $fishCategoryList = $this->fishCategory->getFishCategory();
        //     // $data = cache()->remember('getFishCategoryWiseData', 60 * 60 * 24, function () {
        //     //     return $data = DB::select('CALL get_fish_category_wise_data()');
        //     // });
        //     return view('admin.subject-wise-report.show-fish-category-wise-report')->with([
        //         'divisions' => $divisions,
        //         'subjectTopic' => $subjectTopic,
        //         'fishCategoryList' => $fishCategoryList,
        //         // 'data' => $data,
        //     ]);
        // }

        // fish type wise data
        if (($subjectTopic == 'fish_type_wise') & empty($subjectDivision) & empty($subjectDistrict) & empty($subjectUpazila)) {
            $divisions =  $this->divisionsList->getDivisionList();
            $fishCategoryList = $this->fishCategoryList->getFishCategory();
            $data = cache()->remember('getFishCategoryWiseData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_fish_category_wise_data()');
            });
            return view('admin.subject-wise-report.show-fish-category-wise-report')->with([
                'divisions' => $divisions,
                'subjectTopic' => $subjectTopic,
                'fishCategoryList' => $fishCategoryList,
                'data' => $data,
            ])->render();
        }
        // fish type wise division data
        if (($subjectTopic == 'fish_type_wise') & !empty($subjectDivision) & empty($subjectDistrict) & empty($subjectUpazila)) {
            $district =  $this->districtList->getReportDistrict($subjectDivision);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $fishCategoryList = $this->fishCategoryList->getFishCategory();
            $data = cache()->remember('getFishCategoryWiseDivisionData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_fish_category_wise_division_data()');
            });
            return view('admin.subject-wise-report.show-fish-category-wise-division-report')->with([
                'district' => $district,
                'divisionName' => $divisionName,
                'subjectTopic' => $subjectTopic,
                'fishCategoryList' => $fishCategoryList,
                'data' => $data,
            ])->render();
        }
        // fish type wise district data
        if (($subjectTopic == 'fish_type_wise') & !empty($subjectDivision) & !empty($subjectDistrict) & empty($subjectUpazila)) {
            $upazila =  $this->upazilaList->getReportUpazila($subjectDivision, $subjectDistrict);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $districtName =  $this->districtList->getReportDistrictName($subjectDistrict);
            $fishCategoryList = $this->fishCategoryList->getFishCategory();
            $data = cache()->remember('getFishCategoryWiseDistrictData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_fish_category_wise_district_data()');
            });
            return view('admin.subject-wise-report.show-fish-category-wise-district-report')->with([
                'divisionName' => $divisionName,
                'districtName' => $districtName,
                'upazila' => $upazila,
                'subjectTopic' => $subjectTopic,
                'fishCategoryList' => $fishCategoryList,
                'data' => $data,
            ])->render();
        }
        // fish type wise upazila data
        if (($subjectTopic == 'fish_type_wise') & !empty($subjectDivision) & !empty($subjectDistrict) & !empty($subjectUpazila)) {
            $unionGet =  $this->unionList->getReportUnion($subjectDivision, $subjectDistrict, $subjectUpazila);
            $municipality =  $this->municipalityList->getReportMunicipality($subjectDivision, $subjectDistrict, $subjectUpazila);
            $union = $unionGet->merge($municipality);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $districtName =  $this->districtList->getReportDistrictName($subjectDistrict);
            $upazilaName =  $this->upazilaList->getReportUpazilaName($subjectDivision, $subjectDistrict, $subjectUpazila);
            $fishCategoryList = $this->fishCategoryList->getFishCategory();
            $data = cache()->remember('getFishCategoryWiseUpazilaData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_fish_category_wise_upazila_data()');
            });
            return view('admin.subject-wise-report.show-fish-category-wise-upazila-report')->with([
                'divisionName' => $divisionName,
                'districtName' => $districtName,
                'upazilaName' => $upazilaName,
                'union' => $union,
                'subjectTopic' => $subjectTopic,
                'fishCategoryList' => $fishCategoryList,
                'data' => $data,
            ])->render();
        }
        // fishing place wise data
        if (($subjectTopic == 'place_of_fishing') & empty($subjectDivision) & empty($subjectDistrict) & empty($subjectUpazila)) {
            $divisions =  $this->divisionsList->getDivisionList();
            $placeOfFishingList = $this->placeOfFishings->getFishingPlace();
            $data = cache()->remember('getFishingPlaceWiseData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_fishing_place_wise_data()');
            });
            return view('admin.subject-wise-report.show-fishing-place-wise-report')->with([
                'divisions' => $divisions,
                'subjectTopic' => $subjectTopic,
                'placeOfFishingList' => $placeOfFishingList,
                'data' => $data,
            ])->render();
        }
        // fishing place wise division data
        if (($subjectTopic == 'place_of_fishing') & !empty($subjectDivision) & empty($subjectDistrict) & empty($subjectUpazila)) {
            $district =  $this->districtList->getReportDistrict($subjectDivision);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $placeOfFishingList = $this->placeOfFishings->getFishingPlace();
            $data = cache()->remember('getFishingPlaceWiseDivisionData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_fishing_place_wise_division_data()');
            });
            return view('admin.subject-wise-report.show-fishing-place-wise-division-report')->with([
                'district' => $district,
                'divisionName' => $divisionName,
                'subjectTopic' => $subjectTopic,
                'placeOfFishingList' => $placeOfFishingList,
                'data' => $data,
            ])->render();
        }
        // fishing place wise district data
        if (($subjectTopic == 'place_of_fishing') & !empty($subjectDivision) & !empty($subjectDistrict) & empty($subjectUpazila)) {
            $upazila =  $this->upazilaList->getReportUpazila($subjectDivision, $subjectDistrict);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $districtName =  $this->districtList->getReportDistrictName($subjectDistrict);
            $placeOfFishingList = $this->placeOfFishings->getFishingPlace();
            $data = cache()->remember('getFishingPlaceWiseDistrictData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_fishing_place_wise_district_data()');
            });
            return view('admin.subject-wise-report.show-fishing-place-wise-district-report')->with([
                'divisionName' => $divisionName,
                'districtName' => $districtName,
                'upazila' => $upazila,
                'subjectTopic' => $subjectTopic,
                'placeOfFishingList' => $placeOfFishingList,
                'data' => $data,
            ])->render();
        }
        // fishing place wise upazila data
        if (($subjectTopic == 'place_of_fishing') & !empty($subjectDivision) & !empty($subjectDistrict) & !empty($subjectUpazila)) {
            $unionGet =  $this->unionList->getReportUnion($subjectDivision, $subjectDistrict, $subjectUpazila);
            $municipality =  $this->municipalityList->getReportMunicipality($subjectDivision, $subjectDistrict, $subjectUpazila);
            $union = $unionGet->merge($municipality);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $districtName =  $this->districtList->getReportDistrictName($subjectDistrict);
            $upazilaName =  $this->upazilaList->getReportUpazilaName($subjectDivision, $subjectDistrict, $subjectUpazila);
            $placeOfFishingList = $this->placeOfFishings->getFishingPlace();
            $data = cache()->remember('getFishingPlaceWiseUpazilaData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_fishing_place_wise_upazila_data()');
            });
            return view('admin.subject-wise-report.show-fishing-place-wise-upazila-report')->with([
                'divisionName' => $divisionName,
                'districtName' => $districtName,
                'upazilaName' => $upazilaName,
                'union' => $union,
                'subjectTopic' => $subjectTopic,
                'placeOfFishingList' => $placeOfFishingList,
                'data' => $data,
            ])->render();
        }
        // fish sale place wise data
        if (($subjectTopic == 'sale_place_wise') & empty($subjectDivision) & empty($subjectDistrict) & empty($subjectUpazila)) {
            $divisions =  $this->divisionsList->getDivisionList();
            $fishSalePlacesList = $this->fishSalePlaces->getFishSalePlaces();
            $data = cache()->remember('getFishSalePlaceWiseData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_fish_sale_place_wise_data()');
            });
            return view('admin.subject-wise-report.show-fish-sale-place-wise-report')->with([
                'divisions' => $divisions,
                'subjectTopic' => $subjectTopic,
                'fishSalePlacesList' => $fishSalePlacesList,
                'data' => $data,
            ])->render();
        }
        // fish sale place wise division data
        if (($subjectTopic == 'sale_place_wise') & !empty($subjectDivision) & empty($subjectDistrict) & empty($subjectUpazila)) {
            $district =  $this->districtList->getReportDistrict($subjectDivision);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $fishSalePlacesList = $this->fishSalePlaces->getFishSalePlaces();
            $data = cache()->remember('getFishSalePlaceWiseDivisionData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_fish_sale_place_wise_division_data()');
            });
            return view('admin.subject-wise-report.show-fish-sale-place-wise-division-report')->with([
                'district' => $district,
                'divisionName' => $divisionName,
                'subjectTopic' => $subjectTopic,
                'fishSalePlacesList' => $fishSalePlacesList,
                'data' => $data,
            ])->render();
        }
        // fish sale place wise district data
        if (($subjectTopic == 'sale_place_wise') & !empty($subjectDivision) & !empty($subjectDistrict) & empty($subjectUpazila)) {
            $upazila =  $this->upazilaList->getReportUpazila($subjectDivision, $subjectDistrict);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $districtName =  $this->districtList->getReportDistrictName($subjectDistrict);
            $fishSalePlacesList = $this->fishSalePlaces->getFishSalePlaces();
            $data = cache()->remember('getFishSalePlaceWiseDistrictData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_fish_sale_place_wise_district_data()');
            });
            return view('admin.subject-wise-report.show-fish-sale-place-wise-district-report')->with([
                'divisionName' => $divisionName,
                'districtName' => $districtName,
                'upazila' => $upazila,
                'subjectTopic' => $subjectTopic,
                'fishSalePlacesList' => $fishSalePlacesList,
                'data' => $data,
            ])->render();
        }
        // fish sale place wise upazila data
        if (($subjectTopic == 'sale_place_wise') & !empty($subjectDivision) & !empty($subjectDistrict) & !empty($subjectUpazila)) {
            $unionGet =  $this->unionList->getReportUnion($subjectDivision, $subjectDistrict, $subjectUpazila);
            $municipality =  $this->municipalityList->getReportMunicipality($subjectDivision, $subjectDistrict, $subjectUpazila);
            $union = $unionGet->merge($municipality);
            $divisionName =  $this->divisionsList->getDivisionName($subjectDivision);
            $districtName =  $this->districtList->getReportDistrictName($subjectDistrict);
            $upazilaName =  $this->upazilaList->getReportUpazilaName($subjectDivision, $subjectDistrict, $subjectUpazila);
            $fishSalePlacesList = $this->fishSalePlaces->getFishSalePlaces();
            $data = cache()->remember('getFishSalePlaceWiseUpazilaData', 60 * 60 * 24, function () {
                return $data = DB::select('CALL get_fish_sale_place_wise_upazila_data()');
            });
            return view('admin.subject-wise-report.show-fish-sale-place-wise-upazila-report')->with([
                'divisionName' => $divisionName,
                'districtName' => $districtName,
                'upazilaName' => $upazilaName,
                'union' => $union,
                'subjectTopic' => $subjectTopic,
                'fishSalePlacesList' => $fishSalePlacesList,
                'data' => $data,
            ])->render();
        }
    }
}
