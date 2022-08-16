<?php

namespace App\Models\UserType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;

class UserType extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'user_types';

    protected $fillable = [
        'name', 
        'bnName', 
        'status',
    ];

    public function getUserTypeList()
    {
        return static::orderBy('id','ASC')->get();
    }
    
    public function createUserType($id,$data)
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN'; 
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

    public function updateUserType($userId,$id, $data)
    {
         // return $data;
         $ipaddress = '';
         if (isset($_SERVER['HTTP_CLIENT_IP']))
             $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
         else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
             $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
         else if(isset($_SERVER['HTTP_X_FORWARDED']))
             $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
         else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
             $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
         else if(isset($_SERVER['HTTP_FORWARDED']))
             $ipaddress = $_SERVER['HTTP_FORWARDED'];
         else if(isset($_SERVER['REMOTE_ADDR']))
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
