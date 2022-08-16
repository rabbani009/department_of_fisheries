<?php

namespace App\Http\Controllers\AccessRoute;

use App\Http\Controllers\Controller;
use App\Models\RouteList\RouteList;
use App\Models\User;
use App\Models\UserType\UserType;
use App\Repositories\UserType\UserTypeInterface;
use Illuminate\Http\Request;

class AccessRouteController extends Controller
{
    private $userType;
    public function __construct(
        UserTypeInterface $userType
    ) {
        $this->userType = $userType;
        
    }
    public function accessRoute(){
        $data = $this->userType->getUserTypeList();
        $routeList=RouteList::orderBy('id','ASC')->get();
        return view('admin.access-route.index')->with([
            'data' => $data,
            'routeList' => $routeList,
        ]);
    }
    public function createRouteAccess($id){
        // User::find($id);
        $data=UserType::find($id);
        $routeList=RouteList::orderBy('id','ASC')->get();
        return view('admin.access-route.create')->with([
            'data' => $data,
            'routeList' => $routeList,
        ]);
    }
 
    public function storeRouteAccess(Request $request){
        $routeAccess =implode(",",$request->routeAccess);
        // return gettype($routeAccess);
        // return (object) $request->all();
        $data=UserType::where('id', $request->id)
        ->update(['routeAccess' =>$routeAccess]);
        if ($data) {
            flash('Successfully Added')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }

    public function editRouteAccess($id){
        $data=UserType::find($id);
        $routeList=RouteList::orderBy('id','ASC')->get();
        return view('admin.access-route.edit')->with([
            'data' => $data,
            'routeList' => $routeList,
        ]);
    }
    public function updateRouteAccess(Request $request){
        $data=UserType::find($request->id);
        if(isset($request->routeAccess)){

            $routeAccess =implode(",",$request->routeAccess);
        }else{
            $routeAccess =$data->routeAccess;
        }
        
        // return gettype($routeAccess);
        // return (object) $request->all();
        $data=UserType::where('id', $request->id)
        ->update(['routeAccess' =>$routeAccess]);
        if ($data) {
            flash('Successfully Updated')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
    
    public function deleteRouteAccess($id)
    {
        // return "ok";
        // UserType::find($id)->delete();
        // flash('Successfully Deleted')->success();
        // return back();
        $data=UserType::where('id', $id)
        ->update(['routeAccess' =>'']);
        if ($data) {
            flash('Successfully Deleted')->success();
            return back();
        } else {
            flash('Error')->error();
            return back();
        }
    }
}
