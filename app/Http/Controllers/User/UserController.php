<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\User;
use App\Repositories\Department\DepartmentInterface;
use App\Repositories\Designation\DesignationInterface;
use App\Repositories\User\UserInterface;
use App\Repositories\UserType\UserTypeInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Hash;

class UserController extends Controller
{
    private $user, $designation, $userType, $vavr;

    public function __construct(
         Division $division,
         UserInterface $user,
         DesignationInterface $designation, 
         DepartmentInterface $department, 
         UserTypeInterface $userType
         )
    {
        $this->middleware('auth');
        $this->middleware('preventBackHistory'); 
        $this->user = $user;
        $this->designation = $designation;
        $this->department = $department;
        $this->userType = $userType;
        $this->division = $division;
        // $this->vavr=1;
    }
    public function userList()
    {
        $divisionList = $this->division->getDivisionList();
        $userList = $this->userType->getUserTypeList();
        $data = $this->user->getUserList();
        return view('admin.user.index')->with([
            'data' => $data,
            'divisionList' => $divisionList,
            'userList' => $userList,
        ]);
    }
    public function getUserData(Request $request)
    {
        $division = $request->divisionId;
        $district = $request->districtId;
        $upazila = $request->upazilaId;
        $userRoleId = $request->userRoleId;
        if (empty($userRoleId) & empty($division) & empty($district) & empty($upazila)) {
            $data = $this->user->getUserList();
            return view('admin.user.ajax')->with([
                'data'=>$data,
            ]);
        }
        if (!empty($userRoleId) & empty($division) & empty($district) & empty($upazila)) {
            $data=User::where('userTypeId',$userRoleId)->get();
            return view('admin.user.ajax')->with([
                'data'=>$data,
            ]);
        }
        if (!empty($userRoleId) & !empty($division) & empty($district) & empty($upazila)) {
            $data=User::where('userTypeId',$userRoleId)->where('divisionId',$division)->get();
            return view('admin.user.ajax')->with([
                'data'=>$data,
            ]);
        }
        if (!empty($userRoleId) & !empty($division) & !empty($district) & empty($upazila)) {
            $data=User::where('userTypeId',$userRoleId)->where('divisionId',$division)->where('districtId',$district)->get();
            return view('admin.user.ajax')->with([
                'data'=>$data,
            ]);
        }
        if (!empty($userRoleId) & !empty($division) & !empty($district) & !empty($upazila)) {
            $data=User::where('userTypeId',$userRoleId)->where('divisionId',$division)->where('districtId',$district)->where('upazilaId',$upazila)->get();
            return view('admin.user.ajax')->with([
                'data'=>$data,
            ]);
        }
    }
    public function createUserAccountInformation(Request $request)
    {
        $data = $request->session()->get('stepone');
        return view('admin.user.create-account-information')->with([
            'data' => $data,
        ]);
    }
    public function storeUserAccountInformation(Request $request)
    {
        $getId = Auth::user()->id;
        // return $getId;
        $request->validate([
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
            'passwordConfirmation' => 'required|min:8|same:password',
        ]);
        $data = (object) $request->all();

        $add = $this->user->createUserAccountInformation($getId, $data);
        // return $add;
        if ($add) {
            $request->session()->put('stepone', $add);
            flash('Successfully Added Account Information')->success();
            return redirect()->route('createUserBasicInformation');
        } elseif (empty($add)) {
            flash('!! The Name has already been taken')->error();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function createUserBasicInformation(Request $request)
    {
        if (!empty($request->session()->get('stepone'))) {
            $designationData = $this->designation->getDesignationList();
            $departmentData = $this->department->getDepartmentList();
            $userTypeData = $this->userType->getUserTypeList();
            $divisions = DB::table('divisions')->get();
            return view('admin.user.create-basic-information')->with([
                'designationData' => $designationData,
                'departmentData' => $departmentData,
                'userTypeData' => $userTypeData,
                'divisions' => $divisions,
            ]);
        } else {
            echo "Please add the account information first";
        }
    }
    public function storeUserBasicInformation(Request $request)
    {
        if (!empty($request->session()->get('stepone'))) {
            $stepOne = $request->session()->get('stepone');
            $getId = Auth::user()->id;
            // return $getId;
            $request->validate([
                'name' => 'required',
                'phone' => 'required|unique:users',
                'designationId' => 'required',
                'departmentId' => 'required',
                'userTypeId' => 'required',
                'gender' => 'required',
                'divisionId' => 'required',
                'districtId' => 'required',
                'upazilaId' => 'required',
                // 'address' => 'required',
            ]);
            $data = (object) $request->all();

            $add = $this->user->createUserBasicInformation($getId, $data, $stepOne);
            // return $add;
            if ($add) {
                $request->session()->forget('stepone');
                flash('Successfully Added')->success();
                return redirect()->route('userList');
            } elseif (empty($add)) {
                flash('!! The Name has already been taken')->error();
                return back();
            } else {
                flash('Error')->error();
                return back();
            }
        } else {
            echo "Please add the account information first";
        }
    }

    public function editUser($id)
    {
        $item = $this->user->getSingleUser($id);
        // return $item['upazilaData'];
        $designationData = $this->designation->getDesignationList();
        $departmentData = $this->department->getDepartmentList();
        $userTypeData = $this->userType->getUserTypeList();
        $divisions = DB::table('divisions')->get();
        return view('admin.user.edit')->with([
            'designationData' => $designationData,
            'departmentData' => $departmentData,
            'userTypeData' => $userTypeData,
            'divisions' => $divisions,
            'item' => $item,
        ]);
    }
    public function updateUser(Request $request)
    {
        $userId = Auth::user()->id;
        $data = (object) $request->all();
        $add = $this->user->updateUser($userId, $data->id, $data);
        if ($add) {
            flash('Successfully Updated')->success();
            return back();
        } elseif (empty($add)) {
            flash('The Name has already been taken')->error();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function editSingleUser($id)
    {
        $item = $this->user->getSingleUser($id);
        // return $item['upazilaData'];
        $designationData = $this->designation->getDesignationList();
        $departmentData = $this->department->getDepartmentList();
        $userTypeData = $this->userType->getUserTypeList();
        $divisions = DB::table('divisions')->get();
        return view('admin.user.edit-single-user')->with([
            'designationData' => $designationData,
            'departmentData' => $departmentData,
            'userTypeData' => $userTypeData,
            'divisions' => $divisions,
            'item' => $item,
        ]);
    }
    public function updateSingleUser(Request $request)
    {
        if (!empty($request->oldPassword && $request->newPassword)) {
            $hashedPassword = Auth::user()->password;

            if (\Hash::check($request->oldPassword, $hashedPassword)) {
    
                if (!\Hash::check($request->newPassword, $hashedPassword)) {
                    $userId = Auth::user()->id;
                    $data = (object) $request->all();
                    $add = $this->user->updateUser($userId, $data->id, $data);
                    if ($add) {
                        flash('Successfully Updated')->success();
                        return back();
                    } else {
                        flash('Error')->error();
                        return back();
                    }
                } else {
                    flash('new password can not be the old password!')->error();
                    return redirect()->back();
                }
            } else {
                flash('old password doesnt matched ')->error();
                return redirect()->back();
            }
        } else {
            $userId = Auth::user()->id;
            $data = (object) $request->all();
            $add = $this->user->updateUser($userId, $data->id, $data);
            if ($add) {
                flash('Successfully Updated')->success();
                return back();
            } else {
                flash('Error')->error();
                return back();
            }
        }
    }

    public function deleteUser($id)
    {
        User::find($id)->delete();
        flash('Successfully Deleted')->success();
        return back();
    }

    // public function getDistrictList($divisionId)
    // {
    //     $data = DB::table('divisions')->where('divisionId', $divisionId)->first();
    //     $value = DB::table('districts')->where('divisionId', $data->divisionId)->orderBy('districtEng', 'ASC')->get();
    //     // return $value;
    //     $options = "<option value='' >-- Select District --</option>";
    //     foreach ($value as $item) {
    //         $options .= "<option value='$item->districtId'>$item->districtEng ($item->districtBng)</option>";
    //     }
    //     return response()->json($options);
    // }

    // public function getUpazilaList($id)
    // {
    //     $data = DB::table('districts')->where('districtId', $id)->first();
    //     $value = DB::table('upazilas')->where('districtId', $data->districtId)->orderBy('upazilaEng', 'ASC')->get();
    //     $options = "<option value='' >-- Select Upazila --</option>";
    //     foreach ($value as $item) {
    //         $options .= "<option value='$item->upazilaId'>$item->upazilaEng ($item->upazilaBng)</option>";
    //     }
    //     return response()->json($options);
    // }

    public function getDistrictList(Request $request)
    {
        $value = DB::table('districts')
            ->select('id', 'districtId', 'divisionId', 'districtBng', 'districtEng')
            ->where('divisionId', $request->divisionId)
            ->orderBy('districtEng', 'ASC')
            ->get();
        $options = "<option value='' >-- Select District --</option>";
        foreach ($value as $item) {
            $options .= "<option value='$item->districtId'>$item->districtEng ($item->districtBng)</option>";
        }
        return response()->json($options);
    }
    public function getUpazilaList(Request $request)
    {
        $value = DB::table('upazilas')
            ->select('id', 'districtId', 'divisionId', 'upazilaId', 'upazilaBng', 'upazilaEng')
            ->where('divisionId', $request->divisionId)
            ->where('districtId', $request->districtId)
            ->orderBy('upazilaEng', 'ASC')
            ->get();
        $options = "<option value='' >-- Select Upazila --</option>";
        foreach ($value as $item) {
            $options .= "<option value='$item->upazilaId'>$item->upazilaEng ($item->upazilaBng)</option>";
        }
        return response()->json($options);
    }
    public function getUpazilaListForAdd(Request $request)
    {
        $value = DB::table('upazilas')
            ->select('id', 'districtId', 'divisionId', 'upazilaId', 'upazilaBng', 'upazilaEng')
            ->where('divisionId', $request->divisionId)
            ->where('districtId', $request->districtId)
            ->orderBy('upazilaEng', 'ASC')
            ->get();
            return view('admin.upazila.upazila')->with([
                'upazilaList' =>  $value,
            ]);
    }


    public function getMunicipalityAndUnionList(Request $request)
    {
        // return $request->all();
        $value = DB::table('municipalities')
            ->select('id', 'districtId', 'divisionId', 'upazilaId', 'municipalityId', 'municipalityBangla', 'municipalityEnglish')
            ->where('divisionId', $request->divisionId)
            ->where('districtId', $request->districtId)
            ->where('upazilaId', $request->upazilaId)
            ->orderBy('municipalityEnglish', 'ASC')
            ->get();
        $unionValue = DB::table('unions')
            ->select('id', 'districtId', 'divisionId', 'upazilaId', 'municipalityId', 'unionId', 'unionBng', 'unionEng')
            ->where('divisionId', $request->divisionId)
            ->where('districtId', $request->districtId)
            ->where('upazilaId', $request->upazilaId)
            ->where('municipalityId', '<', 1)
            ->orderBy('unionEng', 'ASC')
            ->get();
        $postOfficeValue = DB::table('post_offices')
            ->where('divisionId', $request->divisionId)
            ->where('districtId', $request->districtId)
            ->where('upazilaId', $request->upazilaId)
            // ->where('municipalityId', $sessionMunicipalityId)
            // ->where('unionId', $sessionUnionId)
            ->orderBy('postOfficeEnglish', 'ASC')
            ->get();
        $municipalityData = "<option value=''>-- Select Municipality --</option>";
        foreach ($value as $item) {
            $municipalityData .= "<option value='$item->municipalityId'>$item->municipalityEnglish ($item->municipalityBangla)</option>";
        }
        $unionData = "<option value=''>-- Select Union --</option>";
        foreach ($unionValue as $unionItem) {
            $unionData .= "<option value='$unionItem->unionId'>$unionItem->unionEng ($unionItem->unionBng)</option>";
        }
        $postOfficeData = "<option value='' >-- Select Post Office --</option>";
        foreach ($postOfficeValue as $postOfficeItem) {
            $postOfficeData .= "<option value='$postOfficeItem->postId'>$postOfficeItem->postOfficeEnglish ($postOfficeItem->postOfficeBangla)</option>";
        }
        return response()->json([
            'municipalityData' => $municipalityData,
            'unionData' => $unionData,
            'postOfficeData' => $postOfficeData
        ]);
    }
    public function getMunicipalityListForAdd(Request $request)
    {
        $value = DB::table('municipalities')
            ->select('id', 'districtId', 'divisionId', 'upazilaId', 'municipalityId', 'municipalityBangla', 'municipalityEnglish')
            ->where('divisionId', $request->divisionId)
            ->where('districtId', $request->districtId)
            ->where('upazilaId', $request->upazilaId)
            ->orderBy('municipalityEnglish', 'ASC')
            ->get();
        $municipalityData = $value;
        return view('admin.municipality.municipality')->with([
            'municipalityData' => $municipalityData,
        ]);
    }
    public function getUnionListForAdd(Request $request)
    {
        $unionValue = DB::table('unions')
            ->select('id', 'districtId', 'divisionId', 'upazilaId', 'municipalityId', 'unionId', 'unionBng', 'unionEng')
            ->where('divisionId', $request->divisionId)
            ->where('districtId', $request->districtId)
            ->where('upazilaId', $request->upazilaId)
            ->where('municipalityId', '<', 1)
            ->orderBy('unionEng', 'ASC')
            ->get();
            $unionValue = $unionValue;
        return view('admin.union.union')->with([
            'unionValue' => $unionValue,
        ]);
    }
    public function getPostOfficeListForAdd(Request $request)
    {
        $postOfficeValue = DB::table('post_offices')
            ->where('divisionId', $request->divisionId)
            ->where('districtId', $request->districtId)
            ->where('upazilaId', $request->upazilaId)
            // ->where('municipalityId', 0)
            // ->where('unionId', $sessionUnionId)
            ->orderBy('postOfficeEnglish', 'ASC')
            ->get();
        return view('admin.postoffice.postoffice')->with([
            'postOfficeValue' => $postOfficeValue,
        ]);
    }
    public function getWardList(Request $request)
    {
        $value = DB::table('unions')
            ->where('divisionId', $request->divisionId)
            ->where('districtId', $request->districtId)
            ->where('upazilaId', $request->upazilaId)
            ->where('municipalityId',$request->municipalityId)
            ->orderBy('unionEng', 'ASC')
            ->get();
        $options = "<option value='' >-- Select Ward --</option>";
        foreach ($value as $item) {
            $options .= "<option value='$item->unionId'>$item->unionEng ($item->unionBng)</option>";
        }
        // Session::forget('sessionPresentDistrictId','sessionPresentDivisionId','sessionPresentUpazilaId','sessionPresentUnionId');
        return response()->json($options);
    }
    public function getWardListForAdd(Request $request)
    {
        $value = DB::table('unions')
            ->where('divisionId', $request->divisionId)
            ->where('districtId', $request->districtId)
            ->where('upazilaId', $request->upazilaId)
            ->where('municipalityId', $request->municipalityId)
            ->orderBy('unionEng', 'ASC')
            ->get();
            $wardData = $value;
            return view('admin.ward.ward')->with([
                'wardData' => $wardData,
            ]);
    }
    public function getVillageList(Request $request)
    {
        $value = DB::table('villages')
            ->where('divisionId', $request->divisionId)
            ->where('districtId', $request->districtId)
            ->where('upazilaId', $request->upazilaId)
            ->where('unionId',$request->unionId)
            ->where('municipalityId', '<', 1)
            ->orderBy('villageEng', 'ASC')
            ->get();
        $options = "<option value='' >-- Select Village --</option>";
        foreach ($value as $item) {
            $options .= "<option value='$item->villageId'>$item->villageEng ($item->villageBng)</option>";
        }
        return response()->json($options);
    }
    public function getVillageListForAdd(Request $request)
    {
        $value = DB::table('villages')
            ->where('divisionId', $request->divisionId)
            ->where('districtId', $request->districtId)
            ->where('upazilaId', $request->upazilaId)
            ->where('unionId', $request->unionId)
            ->where('municipalityId', '<', 1)
            ->orderBy('villageEng', 'ASC')
            ->get();
            return view('admin.village.village')->with([
                'villageList' => $value,
            ]);
    }
    // for present address
    public function getPresentDistrictList(Request $request)
    {
        $value = DB::table('districts')
            ->select('id', 'districtId', 'divisionId', 'districtBng', 'districtEng')
            ->where('divisionId', $request->presentDivisionId)
            ->orderBy('districtEng', 'ASC')
            ->get();
        // return $value;
        $options = "<option value='' >-- Select District --</option>";
        foreach ($value as $item) {
            $options .= "<option value='$item->districtId'>$item->districtEng ($item->districtBng)</option>";
        }
        return response()->json($options);
    }


    public function getPresentUpazilaList(Request $request)
    {
        $value = DB::table('upazilas')
            ->select('id', 'districtId', 'divisionId', 'upazilaId', 'upazilaBng', 'upazilaEng')
            ->where('divisionId', $request->presentDivisionId)
            ->where('districtId', $request->presentDistrictId)
            ->orderBy('upazilaEng', 'ASC')
            ->get();
        // return $value;
        $options = "<option value='' >-- Select Upazila --</option>";
        foreach ($value as $item) {
            $options .= "<option value='$item->upazilaId'>$item->upazilaEng ($item->upazilaBng)</option>";
        }
        return response()->json($options);
    }


    public function getPresentMunicipalityAndUnionList(Request $request)
    {
        $value = DB::table('municipalities')
            ->select('id', 'districtId', 'divisionId', 'upazilaId', 'municipalityId', 'municipalityBangla', 'municipalityEnglish')
            ->where('divisionId', $request->presentDivisionId)
            ->where('districtId', $request->presentDistrictId)
            ->where('upazilaId', $request->presentUpazilaId)
            ->orderBy('municipalityEnglish', 'ASC')
            ->get();
        $unionValue = DB::table('unions')
            ->select('id', 'districtId', 'divisionId', 'upazilaId', 'municipalityId', 'unionId', 'unionBng', 'unionEng')
            ->where('divisionId', $request->presentDivisionId)
            ->where('districtId', $request->presentDistrictId)
            ->where('upazilaId', $request->presentUpazilaId)
            ->where('municipalityId', '<', 1)
            ->orderBy('unionEng', 'ASC')
            ->get();
        $postOfficeValue = DB::table('post_offices')
            ->where('divisionId', $request->presentDivisionId)
            ->where('districtId', $request->presentDistrictId)
            ->where('upazilaId', $request->presentUpazilaId)
            // ->where('municipalityId', $sessionMunicipalityId)
            // ->where('unionId', $sessionUnionId)
            ->orderBy('postOfficeEnglish', 'ASC')
            ->get();
        $municipalityData = "<option value=''>-- Select Municipality --</option>";
        foreach ($value as $item) {
            $municipalityData .= "<option value='$item->municipalityId'>$item->municipalityEnglish ($item->municipalityBangla)</option>";
        }
        $unionData = "<option value=''>-- Select Union --</option>";
        foreach ($unionValue as $unionItem) {
            $unionData .= "<option value='$unionItem->unionId'>$unionItem->unionEng ($unionItem->unionBng)</option>";
        }
        $postOfficeData = "<option value='' >-- Select Post Office --</option>";
        foreach ($postOfficeValue as $postOfficeItem) {
            $postOfficeData .= "<option value='$postOfficeItem->postId'>$postOfficeItem->postOfficeEnglish ($postOfficeItem->postOfficeBangla)</option>";
        }
        return response()->json([
            'municipalityData' => $municipalityData,
            'unionData' => $unionData,
            'postOfficeData' => $postOfficeData
        ]);
    }
    public function getPresentWardList(Request $request)
    {
        $value = DB::table('unions')
            ->where('divisionId', $request->presentDivisionId)
            ->where('districtId', $request->presentDistrictId)
            ->where('upazilaId', $request->presentUpazilaId)
            ->where('municipalityId', $request->presentMunicipalityId)
            ->orderBy('unionEng', 'ASC')
            ->get();
        $options = "<option value='' >-- Select Ward --</option>";
        foreach ($value as $item) {
            $options .= "<option value='$item->unionId'>$item->unionEng ($item->unionBng)</option>";
        }
        // Session::forget('sessionPresentDistrictId','sessionPresentDivisionId','sessionPresentUpazilaId','sessionPresentUnionId');
        return response()->json($options);
    }
    public function getPresentVillageList(Request $request)
    {
        $sessionPresentUpazilaId = Session::get('sessionPresentUpazilaId');
        $value = DB::table('villages')
            ->where('divisionId', $request->presentDivisionId)
            ->where('districtId', $request->presentDistrictId)
            ->where('upazilaId', $request->presentUpazilaId)
            ->where('unionId', $request->presentUnionId)
            ->where('municipalityId', '<', 1)
            ->orderBy('villageEng', 'ASC')
            ->get();
        $options = "<option value='' >-- Select Village --</option>";
        foreach ($value as $item) {
            $options .= "<option value='$item->villageId'>$item->villageEng ($item->villageBng)</option>";
        }
        return response()->json($options);
    }
}
