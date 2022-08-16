<?php

namespace App\Http\Controllers\FishermenInfoStatsInfo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class FishermenInfoStatsInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('preventBackHistory'); 
    }

    public function getFishersInfobyTopic()
    {
        $divisions= DB::table('divisions')->get();
        return view('admin.reports.getFisherListbyTopic')->with(
            [
                'divisions'=>$divisions,
            ]
        );
    }

    public function getReportbyTopic(Request $request)
    {
        $topic = $request->topic;
        $division = $request->divisionId;
        $district = $request->districtId;
        $upazila = $request->upazilaId;
        //number wise start
        if($division==null && $district==null && $upazila==null && $topic=='number_wise')
        {
          

            $numberofFIsherChittagong=cache()->remember('numberofFIsherChittagong',60*60*24, function(){
                return $numberofFIsherChittagong = DB::select('CALL get_number_of_fishers_in_chittagong()');
            });

            $numberofFIsherDhaka=cache()->remember('numberofFIsherDhaka',60*60*24, function(){
                return $numberofFIsherDhaka = DB::select('CALL get_number_of_fishers_in_dhaka()');
            });

            $numberofFIsherKhulna=cache()->remember('numberofFIsherKhulna',60*60*24, function(){
                return $numberofFIsherKhulna = DB::select('CALL get_number_of_fishers_in_khulna()');
            });

            $numberofFIsherRajshahi=cache()->remember('numberofFIsherRajshahi',60*60*24, function(){
                return $numberofFIsherRajshahi = DB::select('CALL get_number_of_fishers_in_rajshahi()');
            });

            $numberofFIsherRangpur=cache()->remember('numberofFIsherRangpur',60*60*24, function(){
                return $numberofFIsherRangpur = DB::select('CALL get_number_of_fishers_in_rangpur()');
            });

            $numberofFIsherSylhet=cache()->remember('numberofFIsherSylhet',60*60*24, function(){
                return $numberofFIsherSylhet = DB::select('CALL get_number_of_fishers_in_sylhet()');
            });
            $output = '<div class="table-responsive">
                                    <table class="table display table-bordered table-striped table-hover basic">
                                        <thead>
                                            <tr>
                                                <th>Sl No</th>
                                                <th>Division</th>
                                                <th>Number of Fisher</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <td>1</td>
                                            <td>Barishal</td>
                                            <td>'.$numberofFIsherBarishal[0]->number.'</td>
                                            </tr>
                                            <tr>
                                            <td>2</td>
                                            <td>Chittagong</td>
                                            <td>'.$numberofFIsherChittagong[0]->number.'</td>
                                            </tr>
                                            <tr>
                                            <td>3</td>
                                            <td>Chittagong</td>
                                            <td>'.$numberofFIsherDhaka[0]->number.'</td>
                                            </tr>
                                            <tr>
                                            <td>4</td>
                                            <td>Khulna</td>
                                            <td>'.$numberofFIsherKhulna[0]->number.'</td>
                                            </tr>
                                            <tr>
                                            <td>5</td>
                                            <td>Rajshahi</td>
                                            <td>'.$numberofFIsherRajshahi[0]->number.'</td>
                                            </tr>
                                            <tr>
                                            <td>6</td>
                                            <td>Rajshahi</td>
                                            <td>'.$numberofFIsherRajshahi[0]->number.'</td>
                                            </tr>
                                            <tr>
                                            <td>7</td>
                                            <td>Rangpur</td>
                                            <td>'.$numberofFIsherRangpur[0]->number.'</td>
                                            </tr>
                                            <tr>
                                            <td>9</td>
                                            <td>Sylhet</td>
                                            <td>'.$numberofFIsherSylhet[0]->number.'</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>';
            echo $output;
        }
        if($division!=null && $district==null && $upazila==null && $topic=='number_wise')
        {
            $getDistrictList = DB::table('districts')->select('districtId','districtEng')->where('divisionId',$division)->cursor();
            
            $output = '<div class="table-responsive">
            <table class="table display table-bordered table-striped table-hover basic">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>District</th>
                        <th>Number of Fisher</th>
                    </tr>
                </thead>
                <tbody>';
       
            foreach($getDistrictList as $key=>$value)
            {   
                $output .='<tr>
                <td>'.++$key.'</td>
                <td>'.$value->districtEng.'</td>
                <td>'.self::getFisherNumberbyDistrict($value->districtId).'</td>
                </tr>';
            }
            $output.='</tbody></table></div>'; 
            echo $output;  
        }
        if($division!=null && $district!=null && $upazila==null && $topic=='number_wise')
        {
            $getUpazilaList = DB::table('upazilas')->select('upazilaId','upazilaEng')->where('districtId',$district)->cursor();
            $output = '<div class="table-responsive">
            <table class="table display table-bordered table-striped table-hover basic">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Upazila</th>
                        <th>Number of Fisher</th>
                    </tr>
                </thead>
                <tbody>';

            foreach($getUpazilaList as $key=>$value)
            {   
                $output .='<tr>
                <td>'.++$key.'</td>
                <td>'.$value->upazilaEng.'</td>
                <td>'.self::getFisherNumberbyUpazila($value->upazilaId).'</td>
                </tr>';
            }
            $output.='</tbody></table></div>'; 
            echo $output;  

        }

        if($division!=null && $district!=null && $upazila!=null && $topic=='number_wise')
        {
            $getUnionList = DB::table('unions')->select('unionId','unionEng','divisionId','districtId')->where('upazilaId',$upazila)->cursor();
            $output = '<div class="table-responsive">
            <table class="table display table-bordered table-striped table-hover basic">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Union</th>
                        <th>Number of Fisher</th>
                    </tr>
                </thead>
                <tbody>';

            foreach($getUnionList as $key=>$value)
            {   
                $output .='<tr>
                <td>'.++$key.'</td>
                <td>'.$value->unionEng.'</td>
                <td>'.self::getFisherNumberbyUnion($value->unionId,$value->divisionId,$value->districtId).'</td>
                </tr>';
            }
            $output.='</tbody></table></div>'; 
            echo $output;  
        }
        //number wise end
        //gender wise start
        if($division==null && $district==null && $upazila==null && $topic=='gender_wise')
        {
            $numberofMaleFisherBarishal = DB::table('fishermen_info_card_prints')->where('divisionId',10)->where('gender','m')->count();
            $numberofFeMaleFisherBarishal = DB::table('fishermen_info_card_prints')->where('divisionId',10)->where('gender','f')->count();
           
            $numberofMaleFisherChittagong = DB::table('fishermen_info_card_prints')->where('divisionId',20)->where('gender','m')->count();
            $numberofFeMaleFisherChittagong = DB::table('fishermen_info_card_prints')->where('divisionId',20)->where('gender','f')->count();

            $numberofMaleFisherDhaka = DB::table('fishermen_info_card_prints')->where('divisionId',30)->where('gender','m')->count();
            $numberofFeMaleFisherDhaka = DB::table('fishermen_info_card_prints')->where('divisionId',30)->where('gender','f')->count();

            $numberofMaleFisherKhulna = DB::table('fishermen_info_card_prints')->where('divisionId',40)->where('gender','m')->count();
            $numberofFeMaleFisherKhulna = DB::table('fishermen_info_card_prints')->where('divisionId',40)->where('gender','f')->count();
            
            $numberofMaleFisherRajshahi = DB::table('fishermen_info_card_prints')->where('divisionId',50)->where('gender','m')->count();
            $numberofFeMaleFisherRajshahi = DB::table('fishermen_info_card_prints')->where('divisionId',50)->where('gender','f')->count();

            $numberofMaleFisherRangpur = DB::table('fishermen_info_card_prints')->where('divisionId',55)->where('gender','m')->count();
            $numberofFeMaleFisherRangpur = DB::table('fishermen_info_card_prints')->where('divisionId',55)->where('gender','f')->count();

            $numberofMaleFisherSylhet = DB::table('fishermen_info_card_prints')->where('divisionId',60)->where('gender','m')->count();
            $numberofFeMaleFisherSylhet = DB::table('fishermen_info_card_prints')->where('divisionId',60)->where('gender','f')->count();

            $output = '<div class="table-responsive">
                                    <table class="table display table-bordered table-striped table-hover basic">
                                        <thead>
                                            <tr>
                                                <th>Sl No</th>
                                                <th>Division</th>
                                                <th>Male</th>
                                                <th>Female</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Barishal</td>
                                                <td>'.$numberofMaleFisherBarishal.'</td>
                                                <td>'.$numberofFeMaleFisherBarishal.'</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Chittagong</td>
                                                <td>'.$numberofMaleFisherChittagong.'</td>
                                                <td>'.$numberofFeMaleFisherChittagong.'</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Dhaka</td>
                                                <td>'.$numberofMaleFisherDhaka.'</td>
                                                <td>'.$numberofFeMaleFisherDhaka.'</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Khulna</td>
                                                <td>'.$numberofMaleFisherKhulna.'</td>
                                                <td>'.$numberofFeMaleFisherKhulna.'</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Rajshahi</td>
                                                <td>'.$numberofMaleFisherRajshahi.'</td>
                                                <td>'.$numberofFeMaleFisherRajshahi.'</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Rangpur</td>
                                                <td>'.$numberofMaleFisherRangpur.'</td>
                                                <td>'.$numberofFeMaleFisherRangpur.'</td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>Sylhet</td>
                                                <td>'.$numberofMaleFisherSylhet.'</td>
                                                <td>'.$numberofFeMaleFisherSylhet.'</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>';
                            echo $output;
        }
        if($division!=null && $district==null && $upazila==null && $topic=='gender_wise')
        {
            $getDistrictList = DB::table('districts')->select('districtId','districtEng')->where('divisionId',$division)->cursor();
            $output = '<div class="table-responsive">
            <table class="table display table-bordered table-striped table-hover basic">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>District</th>
                        <th>Number of Male</th>
                        <th>Number of FeMale</th>
                    </tr>
                </thead>
                <tbody>';
                foreach($getDistrictList as $key=>$value)
                {   
                    $output .='<tr>
                    <td>'.++$key.'</td>
                    <td>'.$value->districtEng.'</td>
                    <td>'.self::getMaleNumberbyDistrict($value->districtId).'</td>
                    <td>'.self::getFemaleNumberbyDistrict($value->districtId).'</td>
                    </tr>';
                }
                $output.='</tbody></table></div>'; 
                echo $output;  
        }
        if($division!=null && $district!=null && $upazila==null && $topic=='gender_wise')
        {
            $getUpazilaList = DB::table('upazilas')->select('upazilaId','upazilaEng')->where('districtId',$district)->cursor();
            $output = '<div class="table-responsive">
            <table class="table display table-bordered table-striped table-hover basic">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Upazilla</th>
                        <th>Number of Male</th>
                        <th>Number of FeMale</th>
                    </tr>
                </thead>
                <tbody>';
                foreach($getUpazilaList as $key=>$value)
                {   
                    $output .='<tr>
                    <td>'.++$key.'</td>
                    <td>'.$value->upazilaEng.'</td>
                    <td>'.self::getMaleNumberbyUpazilla($value->upazilaId).'</td>
                    <td>'.self::getFemaleNumberbyUpazilla($value->upazilaId).'</td>
                    </tr>';
                }
                $output.='</tbody></table></div>'; 
                echo $output;  
        }
        if($division!=null && $district!=null && $upazila!=null && $topic=='gender_wise')
        {
            $getUnionList = DB::table('unions')->select('unionId','unionEng','divisionId','districtId')->where('upazilaId',$upazila)->cursor();
            
            $output = '<div class="table-responsive">
            <table class="table display table-bordered table-striped table-hover basic">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Union</th>
                        <th>Number of Male</th>
                       
                    </tr>
                </thead>
                <tbody>';

            foreach($getUnionList as $key=>$value)
            {   
                $output .='<tr>
                    <td>'.++$key.'</td>
                    <td>'.$value->unionEng.'</td>
                    <td>'.self::getMaleNumberbyUnion($value->unionId,$value->divisionId,$value->districtId).'</td>
                   
                    </tr>';
            }
            $output.='</tbody></table></div>'; 
            echo $output;  
        }
    }
    //gender wise
    public static function getFisherNumberbyDistrict($districtId)
    {
        $numberofFisherinDistrict = DB::table('fishermen_info_card_prints')->where('districtId',$districtId)->count();
        return $numberofFisherinDistrict;
        // $numberofFisherinDistrict = cache()->remember('fishermen_info_card_prints', 60*60*24, function () use ($districtId){
        //     return  DB::table('fishermen_info_card_prints')->where('districtId',$districtId)->count();
        // });

    }

    public static function getFisherNumberbyUpazila($upazilaId)
    {
        $numberofFisherinUpazila = DB::table('fishermen_info_stats_infos')->where('upazillaId',$upazilaId)->count();
        return $numberofFisherinUpazila;
    }

    public static function getFisherNumberbyUnion($union,$division,$district)
    {
        $query = DB::table('fishermen_info_stats_infos')->where('divisionId',$division)->where('districtId',$district)->where('unionId',$union)->count();
        return $query;
    }
    //numberwise
    public static function getMaleNumberbyDistrict($districtId)
    {
        $numberofMale = DB::table('fishermen_info_card_prints')->where('districtId',$districtId)->where('gender','m')->count();
        return $numberofMale;
    }
    public static function getFemaleNumberbyDistrict($districtId)
    {
        $numberofFeMale = DB::table('fishermen_info_card_prints')->where('districtId',$districtId)->where('gender','f')->count();
        return $numberofFeMale;
    }

    public static function getMaleNumberbyUpazilla($upazillaId)
    {
        $numberofFeMale = DB::table('fishermen_info_card_prints')->where('upazillaId',$upazillaId)->where('gender','m')->count();
        return $numberofFeMale;
    }
    public static function getFemaleNumberbyUpazilla($upazillaId)
    {
        $numberofFeMale = DB::table('fishermen_info_card_prints')->where('upazillaId',$upazillaId)->where('gender','f')->count();
        return $numberofFeMale;
    }

    public static function getMaleNumberbyUnion($union,$division,$district)
    {
        $query = DB::table('fishermen_info_card_prints')->where('divisionId',$division)->where('districtId',$district)->where('unionId',$union)->where('gender','m')->count();
        return $query;
    }

    public static function getFeMaleNumberbyUnion($union,$division,$district)
    {
        $query = DB::table('fishermen_info_card_prints')->where('divisionId',$division)->where('districtId',$district)->where('unionId',$union)->where('gender','f')->count();
        return $query;
    }

}
