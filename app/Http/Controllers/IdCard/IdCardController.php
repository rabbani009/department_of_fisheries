<?php

namespace App\Http\Controllers\IdCard;

use App\Http\Controllers\Controller;
use App\Models\FishermenInfoCardPrint;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class IdCardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('preventBackHistory'); 
    }
    public function idCardList(Request $request)
    {
        if ($request->ajax()) {
            $data = FishermenInfoCardPrint::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('QrCode', function ($user) {
                    $qrcode = QrCode::size(80)->generate('Fishers Id: ' . $user->fId . "\n" . 'Name: ' . $user->fishermanNameEng . "\n" . 'National Id No: ' . $user->nationalIdNo . "\n" . 'Date of Birth: ' . date('d-M-Y', strtotime($user->dateOfBirth)) . "\n" . 'Gender: ' . $user->gender);
                    $card = '<div class="form-wrapper m-auto">
                    <div class="form-container form-container-2 my-4">
                        <div class="panel bg-light">
                            <div class="panel-header panel-header-2 text-center mb-3">
                                <div class="row no-gutters">
                                    <div class="col-md-2">
                                        <img src="' . asset('/logo/logo.png') . '" alt="" style="height: 50px !important;" />
                                    </div>
                                    <div class="col-md-8">
                                        <h6>Peoples Republic Of Bangladesh</h6>
                                        <h5 style="text-transform: uppercase;">Department of fisheries</h5>
                                        <h6 style="text-transform: uppercase;">fisherman Id card</h6>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="' . asset('/logo/logo2.png') . '" alt="" style="height: 50px !important;" />
                                    </div>
                                </div>
                            </div>
                
                            <div class="form-group card-form-group">
                                <div class="row justify-content-left">
                                    <div class="col-xs-1 col-sm-1 col-md-1"></div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <img src="' . asset('/logo/user.png') . '" alt="" style="height: 65px !important;" />
                                    </div>
                                    <div class="col-xs-8 col-sm-8 col-md-8">
                                        <table class="table table-card">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div><strong>Name</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>' . $user->fishermanNameEng . '</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Gender</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>' . $user->gender . '</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><strong>Date of Birth</strong></div>
                                                    </td>
                                                    <td>:</td>
                                                    <td>' . date('d-M-Y', strtotime($user->dateOfBirth)) . '</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td>' . $qrcode . '</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                    return $card;
                    // return QrCode::size(50)->generate();
                    // return $btn;
                })
                ->rawColumns(['QrCode'])
                ->make(true);
        }
        return view('admin.id-card.id-card-list');
    }
}
