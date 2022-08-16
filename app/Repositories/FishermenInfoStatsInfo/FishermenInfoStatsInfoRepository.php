<?php

namespace App\Repositories\FishermenInfoStatsInfo;

use App\Models\FishermenInfoStatsInfo;
use App\Repositories\FishermenInfoStatsInfo\FishermenInfoStatsInfoInterface;

class FishermenInfoStatsInfoRepository implements FishermenInfoStatsInfoInterface
{
    public $fishers;

    function __construct(FishermenInfoStatsInfo $fishers) {
	    $this->fishers = $fishers;
    }

    public function getFishermenInfoStatsInfoList()
    {
        return $this->fishers->getFishermenInfoStatsInfoList();
    }
    public function storeFishermenInfoStatsInfo($data)
    {
        return $this->fishers->storeFishermenInfoStatsInfo($data);
    }
 
    public function storeFisherAddress($data)
    {
        return $this->fishers->storeFisherAddress($data);
    }
    public function updateFishermenInfoStatsInfo($id, $data)
    {
        return $this->fishers->updateFishermenInfoStatsInfo($id, $data);
    }
    public function getSingleFishermenInfoStatsInfoData($id)
    {
        return $this->fishers->getSingleFishermenInfoStatsInfoData($id);
    }
    public function getFishermenInfoStatsInfoReportData($data)
    {
        return $this->fishers->getFishermenInfoStatsInfoReportData($data);
    }
    public function viewFisherStatsInfo($id)
    {
        return $this->fishers->viewFisherStatsInfo($id);
    }

    public function storeFishermenFishingInformation($data,$fisherInfoCardId,$personalInformation,$familyInformation,$addressSessionData)
    {
        return $this->fishers->storeFishermenFishingInformation($data,$fisherInfoCardId,$personalInformation,$familyInformation,$addressSessionData);
    }
    public function updateFishermenStats($id,$data)
    {
        return $this->fishers->updateFishermenStats($id,$data);
    }
    public function getSubjectWiseReport()
    {
        return $this->fishers->getSubjectWiseReport();
    }
 
}