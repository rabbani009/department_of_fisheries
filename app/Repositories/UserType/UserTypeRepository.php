<?php

namespace App\Repositories\UserType;

use App\Models\UserType\UserType;
use App\Repositories\UserType\UserTypeInterface;

class UserTypeRepository implements UserTypeInterface
{
    public $userType;

    function __construct(UserType $userType) {
	    $this->userType = $userType;
    }

    public function getUserTypeList()
    {
        return $this->userType->getUserTypeList();
    }
    public function createUserType($id,$data)
    {
        return $this->userType->createUserType($id,$data);
    }
    public function updateUserType($userId,$id, $data)
    {
        return $this->userType->updateUserType($userId,$id, $data);
    }
}