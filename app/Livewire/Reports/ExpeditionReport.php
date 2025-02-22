<?php

namespace App\Livewire\Reports;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Expedition\Entities\Expedition;

class ExpeditionReport extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $area_expedition;
    public $start_date;
    public $end_date;
    public $status_expedition;

    protected $rules = [
        'start_date' => 'required|date|before:end_date',
        'end_date'   => 'required|date|after:start_date',
    ];

    public function mount() {
        $this->area_expedition = '';
        $this->start_date = today()->subDays(30)->format('Y-m-d');
        $this->end_date = today()->format('Y-m-d');
        $this->status_expedition = '';

    }

    public function render() {
        $expeditions = Expedition::whereDate('updated_at', '>=', $this->start_date)
            ->whereDate('updated_at', '<=', $this->end_date)
            ->when($this->status_expedition, function ($query) {
                return $query->where('status_expedition', $this->status_expedition);
            })
            ->when($this->area_expedition, function ($query) {
                return $query->where('area_expedition', $this->area_expedition);
            })
            
            ->orderBy('updated_at', 'desc')->paginate(10);

        return view('livewire.reports.expeditions-report', [
            'expeditions' => $expeditions
        ]);
    }

    public function generateReport() {
        $this->validate();
        $this->render();
    }
}
