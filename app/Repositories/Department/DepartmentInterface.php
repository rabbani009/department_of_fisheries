<?php 

namespace App\Repositories\Department;


interface DepartmentInterface {

    public function getDepartmentList();
    public function createDepartment($id,$data);
    public function updateDepartment($userId, $id, $data);
    
}