<?php

namespace Modules\Machine\DataTables;

use Modules\Machine\Entities\Machine;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MachineDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return view('machine::machines.partials.actions', compact('data'));
            })
            ->addColumn('machine_image', function ($data) {
                $url = $data->getFirstMediaUrl('images', 'thumb');
                return '<img src="' . $url . '" border="0" width="50" class="img-thumbnail" align="center"/>';
            })
          
            ->addColumn('machine_note', function ($data) {
                return ($data->machine_note);
            })
            ->rawColumns(['machine_image']);
    }

    public function query(Machine $model)
    {
        return $model->newQuery()->with('category');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('machine-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->parameters([
                'order' => [[1, 'asc']],
            ])
            ->buttons(
                Button::make('excel')
                    ->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel'),
                Button::make('print')
                    ->text('<i class="bi bi-printer-fill"></i> Print'),
                Button::make('reset')
                    ->text('<i class="bi bi-x-circle"></i> Reset'),
                Button::make('reload')
                    ->text('<i class="bi bi-arrow-repeat"></i> Reload')
            );
    }

    protected function getColumns()
    {
        return [
            Column::computed('machine_image')
                ->title('Imagen')
                ->className('text-center align-middle'),


            Column::make('IDActivo')
                ->title('Código/serie')
                ->className('text-center align-middle'),

            Column::make('DescActivo')
                ->title('Nombre')
                ->className('text-center align-middle'),

            Column::make('category.category_name')
                ->title('Tipo Equipo')
                ->className('text-center align-middle'),
            Column::computed('DescMarca')
                ->title('Marca')
                ->className('text-center align-middle'),
            Column::computed('DescModelo')
                ->title('Modelo')
                ->className('text-center align-middle'),
            Column::computed('DescCliente')
                ->title('Cliente')
                ->className('text-center align-middle'),
            Column::computed('date_manufacture')
                ->title('Fecha Fabricación')
                ->className('text-center align-middle'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle'),

            Column::make('created_at')
                ->visible(false)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'machine_' . date('YmdHis');
    }
}
