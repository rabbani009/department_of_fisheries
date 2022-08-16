<?php

namespace App\Http\Controllers\Designation;

use App\Http\Controllers\Controller;
use App\Models\Designation\Designation;
use App\Repositories\Designation\DesignationInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesignationController extends Controller
{
    private $designation;
    public function __construct(
        DesignationInterface $designation
    ) {
        $this->middleware('auth');
        $this->middleware('preventBackHistory'); 
        $this->designation = $designation;
    }
    public function designationList()
    {
        $data=$this->designation->getDesignationList();
        return view('admin.designation.index')->with([
            'data' => $data
        ]);
    }
    public function storeDesignation(Request $request)
    {
        $getId= Auth::user()->id;
        // return $getId;
        // $request->validate([
        //     'enName' => 'required|unique:designations',
        // ]);
        $data = (object) $request->all();

        $add = $this->designation->createDesignation($getId,$data);
    
        if ($add) {
            flash('Successfully Added')->success();
            return back();
        } elseif(empty($add)) {
            flash('!! The Name has already been taken')->error();
            return back();
        
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function updateDesignation(Request $request)
    {
        $userId= Auth::user()->id;
        // $request->validate([
        //     'name' => 'required',
        // ]);
        $data = (object) $request->all();

        $add = $this->designation->updateDesignation($userId,$data->id, $data);
        // return $add;
        if ($add) {
            flash('Successfully Updated')->success();
            return back();
        } elseif(empty($add)) {
            flash('The Name has already been taken')->error();
            return back();
        
        } else {
            flash('Error')->error();
            return back();
        }
    }

    public function deleteDesignation($id)
    {
        Designation::find($id)->delete();
        flash('Successfully Deleted')->success();
        return back();
    }
}
