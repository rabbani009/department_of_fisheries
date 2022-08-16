<?php 

namespace App\Repositories\UserType;


interface UserTypeInterface {

    public function getUserTypeList();
    public function createUserType($id,$data);
    public function updateUserType($userId,$id, $data);
    
}