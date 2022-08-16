<?php

namespace App\Http\Controllers\FishermenInfoCardPrint;

use App\Http\Controllers\Controller;
use App\Models\FishermenInfoCardPrint;
use App\Models\Upazila;
use App\Repositories\FishermenInfoCardPrint\FishermenInfoCardPrintInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Datatables;
// use PDF;
use App\Exports\FisherDateExport;
use App\Models\FishermenFidDuplicateData;
use App\Models\FishermenNidDuplicateData;
use App\Models\religion;
use Excel;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
//use DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FishermenInfoCardPrintController extends Controller
{
    private $fishers, $religion;
    public function __construct(FishermenInfoCardPrintInterface $fishers, religion $religion)
    {
        $this->middleware('auth');
        $this->middleware('preventBackHistory');
        $this->fishermenInfoCardPrint = $fishers;
        $this->religion = $religion;
    }

    public function fishermenInfoCardPrintList()
    {
        $data = $this->fishermenInfoCardPrint->getFishermenInfoCardPrintList();
        return view('admin.fishermen-info-card-print.index')->with([
            'data' => $data,
            // 'divisions' => $divisions
        ]);
    }

    public function createFishermenInfoCardPrint()
    {
        // $divisions = DB::table('divisions')->orderBy('name', 'ASC')->get();
        $educationalQualifications = DB::table('educational_qualifications')->orderBy('educationalQualification', 'ASC')->get();
        // $fishSalePlace = DB::table('fish_sale_places')->orderBy('id', 'ASC')->get();
        // $placeOfFishing = DB::table('place_of_fishings')->orderBy('id', 'ASC')->get();
        // $fishingTime = DB::table('fishing_times')->orderBy('id', 'ASC')->get();
        // $yearlyLoans = DB::table('yearly_loans')->orderBy('id', 'ASC')->get();
        // $yearlySavings = DB::table('yearly_savings')->orderBy('id', 'ASC')->get();
        // $crisisPeriods = DB::table('crisis_periods')->orderBy('id', 'ASC')->get();
        // $ownerOfVessels = DB::table('owner_of_vessels')->orderBy('id', 'ASC')->get();
        return view('admin.fishermen-info-card-print.create')->with([
            // 'divisions' => $divisions,
            'educationalQualifications' => $educationalQualifications,
            // 'fishSalePlace' => $fishSalePlace,
            // 'placeOfFishing' => $placeOfFishing,
            // 'fishingTime' => $fishingTime,
            // 'yearlyLoans' => $yearlyLoans,
            // 'yearlySavings' => $yearlySavings,
            // 'crisisPeriods' => $crisisPeriods,
            // 'ownerOfVessels' => $ownerOfVessels,
        ]);
    }
    public function storeFishermenInfoCardPrint(Request $request)
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
        $add = $this->fishermenInfoCardPrint->storeFishermenInfoCardPrint($data);
        if ($add) {
            flash('Successfully Added')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function storeFishermenInfoCardPrintAddress(Request $request)
    {
        $data = (object) $request->all();
        // session()->put('data', $data); 
        $add = $this->fishermenInfoCardPrint->storeFisherAddress($data);
        return $add;
    }
    public function getFishermenInfoCardPrintBasicInformation()
    {

        return view('admin.fishermen-info-card-print.basic-information');
    }
    public function viewFishermenInfoCardPrint($id)
    {
        $educationalQualifications = DB::table('educational_qualifications')->orderBy('educationalQualification', 'ASC')->get();
        $data = $this->fishermenInfoCardPrint->getSingleFishermenInfoCardPrintData($id);
        // return $data;
        return view('admin.fishermen-info-card-print.view')->with([
            'data' => $data['singleData'],
            'divisionData' => $data['division'],
            'districtData' => $data['district'],
            'upazilaData' => $data['upazila'],
            'areaData' => $data['area'],
            'educationalQualifications' => $educationalQualifications,

        ]);
    }

    public function editFishermenInfoCardPrint($id)
    {
        $data = $this->fishermenInfoCardPrint->getSingleFishermenInfoCardPrintData($id);
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
        return view('admin.fishermen-info-card-print.edit')->with([
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

    public function updateFishermenInfoCardPrint(Request $request)
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
        $add = $this->fishermenInfoCardPrint->updateFishermenInfoCardPrint($data->id, $data);
        if ($add) {
            flash('Successfully Updated')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }

    public function deleteFishermenInfoCardPrintList($id)
    {
        FishermenInfoCardPrint::find($id)->delete();
        flash('Successfully Deleted')->success();
        return back();
    }

    public function getDistrictList($id)
    {
        $data = DB::table('divisions')->where('id', $id)->first();
        $value = DB::table('districts')->where('division_id', $data->id)->orderBy('name', 'ASC')->get();
        $options = "<option value='' >-- Select District --</option>";
        foreach ($value as $item) {
            $options .= "<option value='$item->id'>$item->name</option>";
        }
        return response()->json($options);
    }

    public function getUpazilaList($id)
    {
        $data = DB::table('districts')->where('id', $id)->first();
        $value = DB::table('upazilas')->where('district_id', $data->id)->orderBy('name', 'ASC')->get();
        $options = "<option value='' >-- Select Upazila --</option>";
        foreach ($value as $item) {
            $options .= "<option value='$item->id'>$item->name</option>";
        }
        return response()->json($options);
    }

    public function getAreaList($id)
    {
        $data = DB::table('upazilas')->where('id', $id)->first();
        $value = DB::table('areas')->where('upazilla_id', $data->id)->orderBy('name', 'ASC')->get();
        $options = "<option value='' >-- Select Areas --</option>";
        foreach ($value as $item) {
            $options .= "<option value='$item->id'>$item->name</option>";
        }
        return response()->json($options);
    }

    public function getFishermenInfoCardPrintReport(Request $request)
    {
        $data = (object) $request->all();
        $add = $this->fishermenInfoCardPrint->getFishermenInfoCardPrintReportData($data);
        $divisions = DB::table('divisions')->orderBy('name', 'ASC')->get();
        return view('admin.fishermen-info-card-print.fishers-report')->with([
            'data' => $add,
            'divisions' => $divisions
        ]);
    }

    public function getDistrictWiseFishermenInfoCardPrint()
    {
        $dhakaDatainfo = array(
            'totalFishermenInfoCardPrint' => 100,
            'totalPeople' => 200,
        );
        return view('admin.reports.districtMap', compact('dhakaDatainfo'));
    }

    public function getFishermenInfoCardPrintInfo()
    {
        return view('admin.reports.fisherList');
    }

    public function getFishermenInfoCardPrintAge(Request $request)
    {
        $birthDay = $request->birthDay;
        $birthMonth = $request->birthMonth;
        $birthYear = $request->birthYear;
        $years = $birthYear . "-" . $birthMonth . "-" . $birthDay;
        // $age = Carbon::parse($years)->age;;
        $age = Carbon::parse($years)->diff(Carbon::now())->format('%y years, %m months and %d days');

        return response()->json([
            'age' => $age,
        ]);
    }


    public function testDatayajra(Request $request)
    {
        $getAllFisherInfo = $this->fishermenInfoCardPrint->getFishermenInfoCardPrintList();
        if ($request->ajax()) {
            $data = FishermenInfoCardPrint::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reports.getFisherListbyDate');
    }

    public function getFishersReportbyDate(Request $request)
    {
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $startLimit = $request->startLimit;
        if ($startLimit == 0) {
            $startLimit = 0;
        } else {
            $startLimit = ($startLimit - 1);
        }

        $endLimit = $request->endLimit;
        $limit = $endLimit - $startLimit;

        if ($request->ajax()) {
            if ($startLimit == 0 && $endLimit == 0) {
                $data = FishermenInfoCardPrint::whereDate('dateOfBirth', '>=', $startDate)
                    ->whereDate('dateOfBirth', '<=', $endDate)->get();
            } elseif ($endLimit != 0) {
                $data = FishermenInfoCardPrint::whereDate('dateOfBirth', '>=', $startDate)
                    ->whereDate('dateOfBirth', '<=', $endDate)->skip($startLimit)->limit($limit)->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($user) {
                    return '<div class="btn-group"><a href="/view-fisher-info/' . $user->id . '" class="edit btn btn-primary btn-sm">View</a></div>';
                })
                // ->addColumn('action', function ($row) {
                //     $btn = '<a href="#!" class="edit btn btn-primary btn-sm">View</a>';
                //     return $btn;
                // })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.reports.getFisherListbyDate');
    }

    public function getFishersInfobyDate()
    {
        return view('admin.reports.getFisherListbyDate');
    }

    public function getFisherReportbyDatePdf(Request $request)
    {
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $startLimit = $request->startLimit;
        if ($startLimit == 0) {
            $startLimit = 0;
        } else {
            $startLimit = ($startLimit - 1);
        }

        $endLimit = $request->endLimit;
        $limit = $endLimit - $startLimit;

        if ($startLimit == 0 && $endLimit == 0) {
            $data = FishermenInfoCardPrint::orderBy('fishermanNameEng', 'asc')->whereDate('dateOfBirth', '>=', $startDate)
                ->whereDate('dateOfBirth', '<=', $endDate)->get();
        } elseif ($endLimit != 0) {
            $data = FishermenInfoCardPrint::orderBy('fishermanNameEng', 'asc')->whereDate('dateOfBirth', '>=', $startDate)
                ->whereDate('dateOfBirth', '<=', $endDate)->skip($startLimit)->limit($limit)->get();
        }

        $list = array(
            'startDate' => $startDate,
            'endDate' => $endDate,
            'fisherList' => $data,
        );

        $fileName = 'fisher-man-list-by-birth.pdf';
        $mPdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 15,
            'margin_bottom' => 20,
            'margin_header' => 10,
            'margin_footer' => 10,
        ]);
        $html = \View::make('testmPdf', ['startDate' => $startDate, 'endDate' => $endDate, 'fisherList' => $data,]);
        $html = $html->render();
        $mPdf->SetHeader('Chapter 1|Department of Fisheries|{PAGENO}');
        $mPdf->SetFooter('This is footer');
        $mPdf->WriteHTML($html);
        $mPdf->Output($fileName, 'I');
    }

    public function getFisherReportbyDateExcel(Request $request)
    {
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $printLimit = $request->printLimit;
        return Excel::download(new FisherDateExport($startDate, $endDate, $printLimit), 'fisherList.xlsx');
    }
    public function getAllFishersInfo(Request $request)
    {
        if ($request->ajax()) {
            $data = FishermenInfoCardPrint::select('*')->where('status', 'Approved');
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
    public function unapprovedFishermenList(Request $request)
    {
        if ($request->ajax()) {
            $data = FishermenInfoCardPrint::where('status', '!=', 'Approved');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('btnAdd', function ($user) {
                    return '<div class="btn-group"><a href="/view-fisher-id-card/' . $user->id . '" class="edit btn btn-info btn-sm">Approved by Upazila Committee</a></div>';
                })
                // ->addColumn('IdCard', function ($user) {
                //     return '<div class="btn-group"><a href="/view-fisher-id-card/' . $user->id . '" class="edit btn btn-info btn-sm">View ID Card</a></div>';
                // })
                ->addColumn('action', function ($user) {
                    return '<div class="btn-group"><a href="/view-fisher-info/' . $user->id . '" class="edit btn btn-primary btn-sm">View</a><a href="/edit-fisher-info/' . $user->id . '" class="edit btn btn-success btn-sm">Edit</a></div>';
                })
                ->rawColumns(['btnAdd','action'])
                ->make(true);
        }
        return view('admin.reports.getUnapprovedFishersInfo');
    }

    public function viewDetailsofFisher($id)
    {
        echo $id;
    }

    public function mpdfGenerate()
    {
        $data = Upazila::all();
        $fileName = 'Upazila_list.pdf';
        $mPdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 15,
            'margin_bottom' => 20,
            'margin_header' => 10,
            'margin_footer' => 10,
        ]);
        $html = \View::make('testmPdf')->with('data', $data);
        $html = $html->render();
        $mPdf->SetHeader('Chapter 1|Department of Fisheries|{PAGENO}');
        $mPdf->SetFooter('This is footer');
        $mPdf->WriteHTML($html);
        $mPdf->Output($fileName, 'I');

        //return view('testmPdf',compact('data'));
    }


    public function getFisherIdCardbyBirthDatePdf(Request $request)
    {
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $startLimit = $request->startLimit;

        if ($startLimit == 0) {
            $startLimit = 0;
        } else {
            $startLimit = ($startLimit - 1);
        }

        $endLimit = $request->endLimit;
        $limit = $endLimit - $startLimit;

        if ($startLimit == 0 && $endLimit == 0) {
            $data = FishermenInfoCardPrint::orderBy('fishermanNameEng', 'asc')->whereDate('dateOfBirth', '>=', $startDate)
                ->whereDate('dateOfBirth', '<=', $endDate)->get()->toArray();
        } elseif ($endLimit != 0) {
            $data = FishermenInfoCardPrint::orderBy('fishermanNameEng', 'asc')->whereDate('dateOfBirth', '>=', $startDate)
                ->whereDate('dateOfBirth', '<=', $endDate)->skip($startLimit)->limit($limit)->get()->toArray();
        }

        $fileName = 'fisher-man-list-by-birth.pdf';
        $mPdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 15,
            'margin_bottom' => 20,
            'margin_header' => 10,
            'margin_footer' => 10,
        ]);
      
        $html = \View::make('admin.id-card.getFishersIdCardList');
        $html = $html->render();
        // $stylesheet = public_path('/css/idcardpdf.css'); 
        // $mPdf->WriteHTML($stylesheet, 1);
        // $stylesheet = file_get_contents('css/idcardpdf.css');
        // $mPdf->WriteHTML($stylesheet, 1);
        $mPdf->WriteHTML($html);
        $mPdf->Output($fileName, 'I');
    }

    public function duplicateFishersData(Request $request)
    {
        if ($request->ajax()) {
            $data = FishermenFidDuplicateData::select('*');
            return Datatables::of($data)
                ->orderColumn('fId', 'fId $1')
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.reports.duplicatedata');
    }

    public function getFishersDuplicateDataPdf(Request $request)
    {
        $data = FishermenFidDuplicateData::orderBy('fId', 'ASC')->get();
        $fileName = 'Duplicate-Fid-Fishers-Data.pdf';
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
        $html = \View::make('admin.id-card.duplicateDataPdf', ['fisherList' => $data]);
        $html = $html->render();
        $mPdf->WriteHTML($html);
        $mPdf->Output($fileName, 'I');
    }

    public function duplicateNidData(Request $request)
    {
        if ($request->ajax()) {
            $data = FishermenNidDuplicateData::select('*');
            return Datatables::of($data)
                ->orderColumn('fId', 'fId $1')
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.reports.duplicateNiddata');
    }

    public function duplicateNidDataPdfPrint()
    {
        $data = FishermenNidDuplicateData::orderBy('nationalIdNo', 'DESC')->get();
        $fileName = 'Duplicate-Fid-Fishers-Data.pdf';
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
        $html = \View::make('admin.id-card.duplicateNidDataPdf', ['dataList' => $data]);
        $html = $html->render();
        $mPdf->WriteHTML($html);
        $mPdf->Output($fileName, 'I');
    }

    // public function approvedByUpazilaCommittee(){

    // }
}
