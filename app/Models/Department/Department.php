<?php

namespace App\Models\Department;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;

class Department extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function getDepartmentListModel()
    {
        return static::orderBy('id', 'ASC')->get();
    }
    public function createDepartment($id, $data)
    {
        $datacount = static::where('enName', $data->enName)->count();
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
        if ($datacount > 0) {
            return False;
        } else {
            $add = new static();
            $add->enName = $data->enName;
            $add->bnName = $data->bnName;
            $add->createdByUserId = $id;
            $add->createdByLoginIp = $ipaddress;
            $add->status = Config::get('constants.Active');
            if ($add->save()) {
                return $add;
            }
            return false;
        }
    }
    public function updateDepartment($userId, $id, $data)
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
            // return $add;
            $add->enName = $data->enName;
            $add->bnName = $data->bnName;
            $add->createdByUserId = $add->createdByUserId;
            $add->createdByLoginIp = $add->createdByLoginIp;
            $add->updatedByUserId = $userId;
            $add->updatedByLoginIp = $ipaddress;
            $add->status = Config::get('constants.Active');
            if ($add->save()) {
                return $add;
            }
            return false;
    }
}
