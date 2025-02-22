<?php

namespace App\Livewire\Reports;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Discharge\Entities\Discharge;
use Barryvdh\DomPDF\Facade\Pdf;

class DischargeReport extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $machines;
    public $start_date;
    public $end_date;
    public $machine_name;
    public $validation_biologic;
    public $status_cycle;

    protected $rules = [
        'start_date' => 'required|date|before:end_date',
        'end_date'   => 'required|date|after:start_date',
    ];

    public function mount()
    {
        $this->machines = '';
        $this->start_date = today()->subDays(30)->format('Y-m-d');
        $this->end_date = today()->format('Y-m-d');
        $this->machine_name = '';
        $this->status_cycle = '';
        $this->validation_biologic = '';
    }

    public function render()
    {
        $discharges = Discharge::whereDate('updated_at', '>=', $this->start_date)
            ->whereDate('updated_at', '<=', $this->end_date)
            ->when($this->machine_name, function ($query) {
                return $query->where('machine_name', $this->machine_name);
            })
            ->when($this->status_cycle, function ($query) {
                return $query->where('status_cycle', $this->status_cycle);
            })
            ->when($this->validation_biologic, function ($query) {
                return $query->where('validation_biologic', $this->validation_biologic);
            })

            ->orderBy('updated_at', 'desc')->paginate(10);

        return view('livewire.reports.discharges-report', [
            'discharges' => $discharges
        ]);
    }

    public function generateReport()
    {
        $this->validate();
        $this->render();
    }


}
