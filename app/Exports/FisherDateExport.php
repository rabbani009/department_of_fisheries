<?php

namespace App\Exports;

use App\Models\Fishers\Fishers;
use App\Models\FishermenInfoCardPrint;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FisherDateExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $startDate,$endDate,$printLimit;

    public function __construct($startDate,$endDate,$printLimit) {
        $this->starDate = $startDate;
        $this->endDate = $endDate;
        $this->printLimit = $printLimit;
    }
    public function headings():array{
        return [
            'FormId',
            'National Id',
            'Post Office English',
            'Post Office Bangla',
            'Fisherman Name',
            'Gender',
            'Fathers Name',
            'Mothers Name',
            'Spouse Name',
            'Date of Birth(YYYY-MM-DD)',
            'Division in Bangla',
            'Division in English',
            'District in Bangla',
            'District in English',
            'Upazila in Bangla',
            'Upazila in English'
        ];
    }
    public function collection()
    {
        return collect(FishermenInfoCardPrint::getFisherforExcelList($this->starDate, $this->endDate,$this->printLimit));
    }
}
