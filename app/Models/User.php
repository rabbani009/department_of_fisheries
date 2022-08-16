<?php

namespace App\Models;

use App\Models\Department\Department;
use App\Models\Designation\Designation;
use App\Models\UserType\UserType;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;
    use HasRoleAndPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function get_user_designation()
    {
        return $this->belongsTo(Designation::class, 'designationId');
    }
    public function get_user_department()
    {
        return $this->belongsTo(Department::class, 'departmentId');
    }
    public function get_user_type()
    {
        return $this->belongsTo(UserType::class, 'userTypeId');
    }
    public function get_user_division()
    {
        return $this->belongsTo(Division::class, 'divisionId', 'divisionId');
    }
    public function get_user_district()
    {
        return $this->belongsTo(District::class, 'districtId', 'districtId');
    }
    public function get_user_upazila()
    {
        return $this->belongsTo(Upazila::class, 'upazilaId', 'upazilaId');
    }
    public function getUserListModel()
    {
        return static::orderBy('id', 'DESC')->with('get_user_designation', 'get_user_department', 'get_user_type', 'get_user_division', 'get_user_district')->get();
    }
    public function createUserAccountInformation($id, $data)
    {
        $add = new static();
        $add->email = $data->email;
        $add->password =  Hash::make($data->password);
        return $add;
    }
    public function createUserBasicInformation($id, $data,$dataTwo)
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        $add = new static();
        $add=$dataTwo;
        $add->name = $data->name;
        // $add->email = $data->email;
        $add->phone = $data->phone;
        $add->designationId = $data->designationId;
        $add->departmentId = $data->departmentId;
        $add->userTypeId = $data->userTypeId;
        $add->gender = $data->gender;
        $add->divisionId = $data->divisionId;
        $add->districtId = $data->districtId;
        $add->upazilaId = $data->upazilaId;
        $add->address = $data->address;
        // $add->password =  Hash::make($data->password);
        $add->createdByUserId = $id;
        $add->createdByLoginIp = $ipaddress;
        $add->status = Config::get('constants.Active');
        if ($add->save()) {
            return $add;
        }
        return false;
    }

    public function getSingleUser($id)
    {
        $data = static::where('id', $id)->with('get_user_designation', 'get_user_department', 'get_user_type', 'get_user_division', 'get_user_district')->first();

        $upazilaData = Upazila::where('divisionId', $data->divisionId)->where('districtId', $data->districtId)->where('upazilaId', $data->upazilaId)->first();
        return [
            'userData' => $data,
            'upazilaData' => $upazilaData,
        ];
    }

    public function updateUser($userId, $id, $data)
    {
        
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        $add = static::find($id);
        $add->name = $data->name;
        $add->email = $data->email;
        $add->phone = $data->phone;
        $add->designationId = $data->designationId;
        $add->departmentId = $data->departmentId;
        $add->userTypeId = $data->userTypeId;
        $add->gender = $data->gender;
        $add->divisionId = $data->divisionId;
        $add->districtId = $data->districtId;
        $add->upazilaId = $data->upazilaId;
        $add->address = $data->address;
        if ($data->newPassword == null) {
            $add->password =  $add->password;
        } else {
            $add->password =  Hash::make($data->newPassword);
        }
        $add->updatedByUserId = $userId;
        $add->updatedByLoginIp = $ipaddress;
        $add->status = $add->status;
        // return $add;
        if ($add->save()) {
            return $add;
        }
        return false;
    }
}
