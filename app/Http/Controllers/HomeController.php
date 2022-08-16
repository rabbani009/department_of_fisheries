<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('preventBackHistory'); 
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return Config::get('constants.Complete');
        return view('admin.dashboard.body-content');
    }

    public function test1()
    {
        // $createDummyPermission = config('roles.models.permission')::create([
        //     'name' => 'Create Dummy Users',
        //     'slug' => 'create.dummyUsers',
        //     'description' => 'This is a test to create permission and assign to a role', // optional
        // ]);

        // $role = config('roles.models.role')::find(4);
        // $role->attachPermission($createDummyPermission);
        // return "done";
      //  return "this is test1 page";
    }

    public function test2()
    {
        return "this is test2 page";
    }

    public function usersRole()
    {
        return redirect()->to('roles');
    }
}
