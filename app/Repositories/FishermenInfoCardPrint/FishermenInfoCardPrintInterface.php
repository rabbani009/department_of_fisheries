<?php 

namespace App\Repositories\FishermenInfoCardPrint;


interface FishermenInfoCardPrintInterface {

    public function getFishermenInfoCardPrintList();
    public function storeFishermenInfoCardPrint($data);
    public function storeFisherBasicInformation($data);
    public function storeFisherAddress($data);
    public function updateFishermenInfoCardPrint($id, $data);
    public function getSingleFishermenInfoCardPrintData($id);
    public function getFishermenInfoCardPrintReportData($data);
    
    public function storeFishermenPersonalInformation($data,$image);
    public function storeFishermenFamilyInformation($data);
    public function storeFishermenAddressInformation($data);
    public function storeFishermenAllCardInformation($userId, $fishermenAddressInfoCard,$fishermenPersonalInfoCard,$fishermenFamilyInfoCard);
    public function viewFishermenInfo($id);

    public function storeFishermenBasicInformation($data);
    public function updateFishermenCard($userId,$data,$image);
// report
    public function subjectBasedReport($data);

    public function countFisherManbyArea($var);
    public function fisherListbyArea($divisionId,$districtId,$upazilaId);
    
}