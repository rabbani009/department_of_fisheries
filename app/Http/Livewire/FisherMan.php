<?php

namespace App\Http\Livewire;

use App\Models\FishermenInfoCardPrint;
use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\FisherDateExport;
use Excel;
use PDF;

class FisherMan extends Component
{
    public $paginate=5;
    public $search = '';
    public $startDate= '';
    public $endDate = '';
    public $message;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.fisher-man',[
            'getAllFishers' => FishermenInfoCardPrint::search(trim($this->search))->getfisherdatabydate($this->startDate,$this->endDate)->paginate($this->paginate),
        ]);
    }

    public function getPDF()
    {
        $fishers =  FishermenInfoCardPrint::getfisherdata($this->startDate,$this->endDate);
        $data = [
            'title' => 'Welcome to Mywebtuts.com',
            'date' => date('d/m/Y'),
            'users' => $fishers
        ]; 

        $pdfContent = PDF::loadView('livewire.reports.fishersListbyDate', $data)->output();
        return response()->streamDownload(
            fn () => print($pdfContent),
            "fishersList.pdf"
        );

    }

    public function getExcel()
    {
        return Excel::download(new FisherDateExport($this->startDate,$this->endDate),'fisherList.xlsx');
    }

}
