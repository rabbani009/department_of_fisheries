<?php

namespace App\Repositories\FishermenInfoCardPrint;

use App\Models\FishermenInfoCardPrint;
use App\Repositories\FishermenInfoCardPrint\FishermenInfoCardPrintInterface;

class FishermenInfoCardPrintRepository implements FishermenInfoCardPrintInterface
{
    public $fishers;

    function __construct(FishermenInfoCardPrint $fishers) {
	    $this->fishers = $fishers;
    }

    public function getFishermenInfoCardPrintList()
    {
        return $this->fishers->getFishermenInfoCardPrintList();
    }
    public function storeFishermenInfoCardPrint($data)
    {
        return $this->fishers->storeFishermenInfoCardPrint($data);
    }
    public function storeFisherBasicInformation($data)
    {
        return $this->fishers->storeFisherBasicInformation($data);
    }
    public function storeFisherAddress($data)
    {
        return $this->fishers->storeFisherAddress($data);
    }
    public function updateFishermenInfoCardPrint($id, $data)
    {
        return $this->fishers->updateFishermenInfoCardPrint($id, $data);
    }
    public function getSingleFishermenInfoCardPrintData($id)
    {
        return $this->fishers->getSingleFishermenInfoCardPrintData($id);
    }
    public function getFishermenInfoCardPrintReportData($data)
    {
        return $this->fishers->getFishermenInfoCardPrintReportData($data);
    }

    public function storeFishermenBasicInformation($data)
    {
        return $this->fishers->storeFishermenBasicInformation($data);
    }
    public function storeFishermenPersonalInformation($data,$image)
    {
        return $this->fishers->storeFishermenPersonalInformation($data,$image);
    }
    public function storeFishermenFamilyInformation($data)
    {
        return $this->fishers->storeFishermenFamilyInformation($data);
    }
    public function storeFishermenAddressInformation($data)
    {
        return $this->fishers->storeFishermenAddressInformation($data);
    }
    public function storeFishermenAllCardInformation($userId, $fishermenAddressInfoCard,$fishermenPersonalInfoCard,$fishermenFamilyInfoCard)
    {
        return $this->fishers->storeFishermenAllCardInformation($userId, $fishermenAddressInfoCard,$fishermenPersonalInfoCard,$fishermenFamilyInfoCard);
    }
    public function viewFishermenInfo($id)
    {
        return $this->fishers->viewFishermenInfo($id);
    }
    public function updateFishermenCard($userId,$data,$image)
    {
        return $this->fishers->updateFishermenCard($userId,$data,$image);
    }
    // report
    public function subjectBasedReport($data)
    {
        return $this->fishers->subjectBasedReport($data);
    }

    public function countFisherManbyArea($var)
    {
        return $this->fishers->countFisherManbyArea($var);
    }
    public function fisherListbyArea($divisionId,$districtId,$upazilaId)
    {
        return $this->fishers->fisherListbyArea($divisionId,$districtId,$upazilaId);
    }
    
}