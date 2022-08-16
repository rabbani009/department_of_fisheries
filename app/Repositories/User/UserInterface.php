<?php 

namespace App\Repositories\User;


interface UserInterface {

    public function getUserList();
    public function getSingleUser($id);
    public function createUserAccountInformation($id,$data);
    public function createUserBasicInformation($id,$data,$dataTwo);
    public function updateUser($userId, $id, $data);
    
}