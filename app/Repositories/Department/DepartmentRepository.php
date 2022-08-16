<?php

namespace App\Repositories\Department;

use App\Models\Department\Department;
use App\Repositories\Department\DepartmentInterface;

class DepartmentRepository implements DepartmentInterface
{
    public $department;

    function __construct(Department $department) {
	    $this->department = $department;
    }

    public function getDepartmentList()
    {
        return $this->department->getDepartmentListModel();
    }
    public function createDepartment($id,$data)
    {
        return $this->department->createDepartment($id,$data);
    }
    public function updateDepartment($userId, $id, $data)
    {
        return $this->department->updateDepartment($userId, $id, $data);
    }
}