<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\User\UserInterface;

class UserRepository implements UserInterface
{
    public $user;

    function __construct(User $user) {
	    $this->user = $user;
    }

    public function getUserList()
    {
        return $this->user->getUserListModel();
    }
    public function getSingleUser($id)
    {
        return $this->user->getSingleUser($id);
    }
    public function createUserAccountInformation($id,$data)
    {
        return $this->user->createUserAccountInformation($id,$data);
    }
    public function createUserBasicInformation($id,$data,$dataTwo)
    {
        return $this->user->createUserBasicInformation($id,$data,$dataTwo);
    }
    public function updateUser($userId, $id, $data)
    {
        return $this->user->updateUser($userId, $id, $data);
    }
}