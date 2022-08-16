<?php 

namespace App\Repositories\Designation;


interface DesignationInterface {

    public function getDesignationList();
    public function createDesignation($id,$data);
    public function updateDesignation($userId, $id, $data);
    
}