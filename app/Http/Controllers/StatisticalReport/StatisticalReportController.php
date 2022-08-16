<?php

namespace App\Http\Controllers\StatisticalReport;

use App\Http\Controllers\Controller;
use App\Models\DeficiencyPeriod;
use App\Models\Division;
use App\Models\FishCategory;
use App\Models\FishingPlace;
use App\Models\YearlySaving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticalReportController extends Controller
{
    private
        $yearlySaving,
        $deficiencyPeriod,
        $fishCategoryList,
        $fishSalePlaces,
        $placeOfFishingList,
        $divisionsList;

    public function __construct(
        Division $divisionsList,
        DeficiencyPeriod $deficiencyPeriod,
        FishCategory $fishCategoryList,
        FishingPlace $placeOfFishingList,
        YearlySaving $yearlySaving
    ) {
        $this->middleware('auth');
        $this->middleware('preventBackHistory'); 
        $this->divisionsList = $divisionsList;
        $this->yearlySaving = $yearlySaving;
        $this->deficiencyPeriod = $deficiencyPeriod;
        $this->fishCategoryList = $fishCategoryList;
        $this->placeOfFishings = $placeOfFishingList;
    }
    public function statisticalReport()
    {
        $divisions =  $this->divisionsList->getDivisionList();
        $yearlySaving = $this->yearlySaving->getYearlySaving();
        $deficiencyPeriod = $this->deficiencyPeriod->getDeficiencyPeriod();
        $fishCategoryList = $this->fishCategoryList->getFishCategory();
        $placeOfFishingList = $this->placeOfFishings->getFishingPlace();
        // Area wise number of fishermen 
        $data = cache()->remember('getNumberWiseData', 60 * 60 * 24, function () {
            return $data = DB::select('CALL get_number_wise_data()');
        });

        $chartData = "";
        foreach ($divisions as $item) {
            foreach (collect($data)->where('divisionId', $item->divisionId) as $getData) {
                $chartData .= "['" . $item->divisionEng . " (" . $item->divisionBng . ")" . "'," . $getData->total . "],";
            }
        }
        $pieChart = rtrim($chartData, ",");
        // YearlySaving
        $getYearlySaving = cache()->remember('getYearlyLoanAndYearlySavingWiseData', 60 * 60 * 24, function () {
            return $getYearlySaving = DB::select('CALL get_yearly_loan_and_yearly_savings_data()');
        });
        $yearlySavingData = "";
        foreach ($yearlySaving as $item) {
            ${'yearlySaving' . $item->id} = 0;
            ${'yearlyLoan' . $item->id} = 0;
        }
        foreach ($yearlySaving as $item) {
            foreach (collect($getYearlySaving)->where('yearlySaving', $item->id) as $getData) {

                ${'yearlySaving' . $item->id} += $getData->total;
            }
            foreach (collect($getYearlySaving)->where('yearlyLoan', $item->id) as $getData) {

                ${'yearlyLoan' . $item->id} += $getData->total;
            }
        }
        foreach ($yearlySaving as $item) {
            $getValueyearlySaving = ${'yearlySaving' . $item->id};
            $getValueyearlyLoan = ${'yearlyLoan' . $item->id};
            $yearlySavingData .= "['" .  $item->yearlySavingBng . "'," . $getValueyearlySaving . "," . $getValueyearlyLoan . "],";
        }
        $yearlySavingDataa = rtrim($yearlySavingData, ",");
        // get_danger_period_of_living_data
        $getDangerPeriodData = cache()->remember('getDangerPeriodOfLivingData', 60 * 60 * 24, function () {
            return $getDangerPeriodData = DB::select('CALL get_danger_period_of_living_data()');
        });

        $chartDeficiencyPeriod = "";
        foreach ($deficiencyPeriod as $item) {
            foreach (collect($getDangerPeriodData)->where('dangerPeriodOfLiving', $item->id) as $getData) {
                $chartDeficiencyPeriod .= "['" . $item->deficiencyPeriodEng . " (" . $item->deficiencyPeriodBng . ")" . "'," . $getData->total . "],";
            }
        }
        $pieChartDeficiencyPeriod = rtrim($chartDeficiencyPeriod, ",");
        // typeOfFish
        $typeOfFish = cache()->remember('getFishCategoryData', 60 * 60 * 24, function () {
            return $typeOfFish = DB::select('CALL get_fish_category_data()');
        });
        $typeOfFishData = "";
        foreach ($fishCategoryList as $item) {
            ${'getCategory' . $item->id} = 0;
            $color=0;
        }
        foreach ($fishCategoryList as $item) {
            foreach (collect($typeOfFish) as $getData) {

                $dataFishCategoryList = explode(',', $getData->typeOfFish);
                if (in_array($item->id, $dataFishCategoryList)) {
                    ${'getCategory' . $item->id} += $getData->total;
                }
                // $typeOfFishData .= "['" .  $item->categoryEng . "',"  . $getData->total .",'".'silver'."'],";
            }
        }
        foreach ($fishCategoryList as $item) {
            ${'getCategory' . $item->id} += $getData->total;
            $totalData = ${'getCategory' . $item->id};
            $typeOfFishData .= "['" .  $item->categoryBng . "',"  . $totalData . ",'" .$color. "'],";
        }
        $typeOfFishDataChart = rtrim($typeOfFishData, ",");
        // salePlaceOfFish
        $salePlaceOfFish = cache()->remember('getPlaceOfFishingData', 60 * 60 * 24, function () {
            return $salePlaceOfFish = DB::select('CALL get_place_of_fishing_data()');
        });
        $salePlaceOfFishData = "";
        foreach ($placeOfFishingList as $item) {
            ${'getFishingPlace' . $item->id} = 0;
            $color=0;
        }
        foreach ($placeOfFishingList as $item) {
            foreach (collect($salePlaceOfFish) as $getData) {
                $datafishCategoryList = explode(',', $getData->placeOfFishing);
                if (in_array($item->id, $datafishCategoryList)) {
                    ${'getFishingPlace' . $item->id} += $getData->total;
                }
               
            }
        }
        foreach ($placeOfFishingList as $item) {
            ${'getFishingPlace' . $item->id} += $getData->total;
            $totalData = ${'getFishingPlace' . $item->id};
            $salePlaceOfFishData .= "['" .  $item->placeBng . "',"  . $totalData . ",'" .$color. "'],";
        }
        $salePlaceOfFishDataChart = rtrim($salePlaceOfFishData, ",");

        return view('admin.statistical-report.statistical-report')->with([
            'arr' => $pieChart,
            'yearlySavingDataa' => $yearlySavingDataa,
            'pieChartDeficiencyPeriod' => $pieChartDeficiencyPeriod,
            'typeOfFishDataChart' => $typeOfFishDataChart,
            'salePlaceOfFishDataChart' => $salePlaceOfFishDataChart,
        ]);
    }
}
