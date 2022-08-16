<?php 

namespace App\Repositories\FishermenInfoStatsInfo;


interface FishermenInfoStatsInfoInterface {

    public function getFishermenInfoStatsInfoList();
    public function storeFishermenInfoStatsInfo($data);
    public function storeFisherAddress($data);
    public function updateFishermenInfoStatsInfo($id, $data);
    public function getSingleFishermenInfoStatsInfoData($id);
    public function getFishermenInfoStatsInfoReportData($data);
    
    public function storeFishermenFishingInformation($data,$fisherInfoCardId,$personalInformation,$familyInformation,$addressSessionData);
    public function viewFisherStatsInfo($id);

    public function updateFishermenStats($id,$data);
    public function getSubjectWiseReport();
}