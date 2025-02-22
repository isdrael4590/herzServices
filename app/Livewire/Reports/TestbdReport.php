<?php

namespace App\Livewire\Reports;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Testbd\Entities\Testbd;

class TestbdReport extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $machines;
    public $start_date;
    public $end_date;
    public $machine_id;
    public $testbd_validation;

    protected $rules = [
        'start_date' => 'required|date|before:end_date',
        'end_date'   => 'required|date|after:start_date',
    ];

    public function mount($machines) {
        $this->machines = $machines;
        $this->start_date = today()->subDays(30)->format('Y-m-d');
        $this->end_date = today()->format('Y-m-d');
        $this->machine_id = '';
        $this->testbd_validation = '';
    }

    public function render() {
        $testbds = Testbd::whereDate('updated_at', '>=', $this->start_date)
            ->whereDate('updated_at', '<=', $this->end_date)
            ->when($this->machine_id, function ($query) {
                return $query->where('machine_id', $this->machine_id);
            })
            ->when($this->testbd_validation, function ($query) {
                return $query->where('validation_bd', $this->testbd_validation);
            })
            
            ->orderBy('updated_at', 'desc')->paginate(20);

        return view('livewire.reports.testbds-report', [
            'testbds' => $testbds
        ]);
    }

    public function generateReport() {
        $this->validate();
        $this->render();
    }
}
