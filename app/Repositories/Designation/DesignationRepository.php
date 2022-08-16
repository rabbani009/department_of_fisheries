<?php

namespace App\Repositories\Designation;

use App\Models\Designation\Designation;
use App\Repositories\Designation\DesignationInterface;

class DesignationRepository implements DesignationInterface
{
    public $designation;

    function __construct(Designation $designation) {
	    $this->designation = $designation;
    }

    public function getDesignationList()
    {
        return $this->designation->getDesignationListModel();
    }
    public function createDesignation($id,$data)
    {
        return $this->designation->createDesignation($id,$data);
    }
    public function updateDesignation($userId, $id, $data)
    {
        return $this->designation->updateDesignation($userId, $id, $data);
    }
}