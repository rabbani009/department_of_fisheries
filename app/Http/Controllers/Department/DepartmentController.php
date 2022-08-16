<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Models\Department\Department;
use App\Repositories\Department\DepartmentInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    private $department;
    public function __construct(
        DepartmentInterface $department
    ) {
        $this->middleware('auth');
        $this->middleware('preventBackHistory'); 
        $this->department = $department;
    }
    public function departmentList()
    {
        // $clientIP = exec('getmac');
        // $clientIP = request()->ip();
        // $clientIP =  $_SERVER['REMOTE_ADDR'];
        // return $clientIP;

        // new
        // $ipaddress = '';
        // if (isset($_SERVER['HTTP_CLIENT_IP']))
        //     $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        // else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        //     $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        // else if(isset($_SERVER['HTTP_X_FORWARDED']))
        //     $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        // else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        //     $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        // else if(isset($_SERVER['HTTP_FORWARDED']))
        //     $ipaddress = $_SERVER['HTTP_FORWARDED'];
        // else if(isset($_SERVER['REMOTE_ADDR']))
        //     $ipaddress = $_SERVER['REMOTE_ADDR'];
        // else
        //     $ipaddress = 'UNKNOWN';    
        // return $ipaddress;
        // $serial =  shell_exec('wmic DISKDRIVE GET SerialNumber 2>&1');

        // return $serial;
        $data=$this->department->getDepartmentList();
        return view('admin.department.index')->with([
            'data' => $data
        ]);
    }
    public function storeDepartment(Request $request)
    {
        $getId= Auth::user()->id;
        // return $getId;
        // $request->validate([
        //     'name' => 'required',
        // ]);
        $data = (object) $request->all();

        $add = $this->department->createDepartment($getId,$data);
        if ($add) {
            flash('Successfully Added')->success();
            return back();
        }elseif(empty($add)) {
            flash('!! The Name has already been taken')->error();
            return back();
        
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function updateDepartment(Request $request)
    {
        $userId= Auth::user()->id;
        // $request->validate([
        //     'name' => 'required',
        // ]);
        $data = (object) $request->all();

        $add = $this->department->updateDepartment($userId,$data->id, $data);
        // return $add;
        if ($add) {
            flash('Successfully Updated')->success();
            return back();
        }elseif(empty($add)) {
            flash('The Name has already been taken')->error();
            return back();
        
        } else {
            flash('Error')->error();
            return back();
        }
    }

    public function deleteDepartment($id)
    {
        Department::find($id)->delete();
        flash('Successfully Deleted')->success();
        return back();
    }
}
