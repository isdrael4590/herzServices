<?php

namespace Modules\Informat\DataTables;

use Modules\Informat\Entities\Informat;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InformatDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return view('informat::informats.partials.actions', compact('data'));
            });
    }

    public function query(Informat $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('Informat-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->orderBy(2)
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
            Column::make('insumo_name')
                ->title('Nombre del insumo')
                ->addClass('text-center'),

            Column::make('insumo_code')
                ->title('Código del insumo')
                ->addClass('text-center'),

            Column::make('insumo_type')
                ->title('Tipo Insumo')
                ->addClass('text-center'),

            Column::make('insumo_temp')
                ->title('Temp. Insumo')
                ->addClass('text-center'),

            Column::make('insumo_lot')
                ->title('Lote Insumo')
                ->addClass('text-center'),

            Column::make('insumo_exp')
                ->title('Venc Insumo')
                ->addClass('text-center'),

            Column::make('insumo_status')
                ->title('Estado Insumo')
                ->addClass('text-center'),

            Column::computed('action')
                ->title('Acción')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),


        ];
    }

    protected function filename(): string
    {
        return 'Informat_' . date('YmdHis');
    }
}
