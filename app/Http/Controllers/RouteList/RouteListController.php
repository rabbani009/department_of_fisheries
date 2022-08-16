<?php

namespace App\Http\Controllers\RouteList;

use App\Http\Controllers\Controller;
use App\Models\RouteList\RouteList;
use Illuminate\Http\Request;

class RouteListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('preventBackHistory'); 
    }
    public function routeList()
    {
        // return Auth::user()->id;
        $data = RouteList::get();
        return view('admin.route.index')->with([
            'data' => $data
        ]);
    }
    public function storeRoute(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        // ]);
        // $data = (object) $request->all();

        // $add = $this->userType->createUserType($data);
        $add=new RouteList();
        $add->routeName=$request->routeName;
        if ($add->save()) {
            flash('Successfully Added')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    public function updateRoute(Request $request)
    {
        $add=RouteList::find($request->id);
        $add->routeName=$request->routeName;
        if ($add->save()) {
            flash('Successfully Updated')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }

    public function deleteRoute($id)
    {
        RouteList::find($id)->delete();
        flash('Successfully Deleted')->success();
        return back();
    }
}
