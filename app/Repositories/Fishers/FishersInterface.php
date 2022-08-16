<?php 

namespace App\Repositories\Fishers;


interface FishersInterface {

    public function getFishersList();
    public function storeFishers($data);
    public function storeFisherBasicInformation($data);
    public function storeFisherAddress($data);
    public function updateFishers($id, $data);
    public function getSingleFishersData($id);
    public function getFishersReportData($data);
    
}