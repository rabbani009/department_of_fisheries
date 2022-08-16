<?php

namespace App\Http\Controllers\UserType;

use App\Http\Controllers\Controller;
use App\Models\UserType\UserType;
use App\Repositories\UserType\UserTypeInterface;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserTypeController extends Controller
{
    private $userType;
    public function __construct(
        UserTypeInterface $userType
    ) {
        $this->middleware('auth');
        $this->middleware('preventBackHistory'); 
        $this->userType = $userType;
    }
    public function userTypeList()
    {
        $userId = Auth::user()->id;
        $user = config('roles.models.defaultUser')::find($userId);
        // $user = User::find(2);
        if ($user->hasRole('admin')) {
            if ($user->hasPermission('view.allroles')) { // you can pass an id or slug
                $data = $this->userType->getUserTypeList();
                return view('admin.user-type.index')->with([
                    'data' => $data
                ]);
            }
        } elseif ($user->hasRole('user')) {
            if ($user->hasPermission('view.allroles')) { // you can pass an id or slug
                $data = $this->userType->getUserTypeList();
                return view('admin.user-type.index')->with([
                    'data' => $data
                ]);
            } else {
                return "you dont have permission";
            }
        }
        //Hello
        // return Auth::user()->id;
        // $data = $this->userType->getUserTypeList();
        // return view('admin.user-type.index')->with([
        //     'data' => $data
        // ]);
    }
    public function storeUserType(Request $request)
    {
        $getId = Auth::user()->id;
        $request->validate([
            'enName' => 'required',
        ]);
        $data = (object) $request->all();

        $add = $this->userType->createUserType($getId, $data);
        if ($add) {
            flash('Successfully Added')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function updateUserType(Request $request)
    {
        $userId = Auth::user()->id;
        $request->validate([
            'enName' => 'required',
        ]);
        $data = (object) $request->all();

        $add = $this->userType->updateUserType($userId, $data->id, $data);
        if ($add) {
            flash('Successfully Updated')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }

    public function deleteUserType($id)
    {
        UserType::find($id)->delete();
        flash('Successfully Deleted')->success();
        return back();
    }
}
