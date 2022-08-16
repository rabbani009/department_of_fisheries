<?php

namespace App\Repositories\Fishers;

use App\Models\Fishers\Fishers;
use App\Models\Fisherss\Fisherss;
use App\Repositories\Fishers\FishersInterface;

class FishersRepository implements FishersInterface
{
    public $fishers;

    function __construct(Fishers $fishers) {
	    $this->fishers = $fishers;
    }

    public function getFishersList()
    {
        return $this->fishers->getFishersList();
    }
    public function storeFishers($data)
    {
        return $this->fishers->storeFishers($data);
    }
    public function storeFisherBasicInformation($data)
    {
        return $this->fishers->storeFisherBasicInformation($data);
    }
    public function storeFisherAddress($data)
    {
        return $this->fishers->storeFisherAddress($data);
    }
    public function updateFishers($id, $data)
    {
        return $this->fishers->updateFishers($id, $data);
    }
    public function getSingleFishersData($id)
    {
        return $this->fishers->getSingleFishersData($id);
    }
    public function getFishersReportData($data)
    {
        return $this->fishers->getFishersReportData($data);
    }
}