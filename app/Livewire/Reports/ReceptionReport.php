<?php

namespace App\Livewire\Reports;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Reception\Entities\Reception;

class ReceptionReport extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $areas;
    public $start_date;
    public $end_date;
    public $area_id;
    public $status_reception;

    protected $rules = [
        'start_date' => 'required|date|before:end_date',
        'end_date'   => 'required|date|after:start_date',
    ];

    public function mount($areas) {
        $this->areas = $areas;
        $this->start_date = today()->subDays(30)->format('Y-m-d');
        $this->end_date = today()->format('Y-m-d');
        $this->area_id = '';
        $this->status_reception = '';
    }

    public function render() {
        $receptions = Reception::whereDate('updated_at', '>=', $this->start_date)
            ->whereDate('updated_at', '<=', $this->end_date)
            ->when($this->area_id, function ($query) {
                return $query->where('area_id', $this->area_id);
            })
            ->when($this->status_reception, function ($query) {
                return $query->where('status', $this->status_reception);
            })
            
            ->orderBy('updated_at', 'desc')->paginate(20);

        return view('livewire.reports.receptions-report', [
            'receptions' => $receptions
        ]);
    }

    public function generateReport() {
        $this->validate();
        $this->render();
    }
}
