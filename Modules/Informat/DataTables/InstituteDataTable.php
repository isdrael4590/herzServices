<?php

namespace Modules\Informat\DataTables;

use Modules\Informat\Entities\Institute;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InstituteDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return view('informat::institutes.partials.actions', compact('data'));
            })
            ->addColumn('image_institute', function ($data) {
                $url = $data->getFirstMediaUrl('institutes', 'thumb');
                return '<img src="'.$url.'" border="0" width="50" class="img-thumbnail" align="center"/>';
            })
            ->rawColumns(['image_institute']);
    }

    public function query(Institute $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('Informat_Institute-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->orderBy(7)
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
            Column::computed('image_institute')
            ->title('Logo Institución')
            ->addClass('text-center'),
            Column::make('institute_code')
                ->title('Código Institución')
                ->addClass('text-center'),

            Column::make('institute_name')
                ->title('Nombre Institución')
                ->addClass('text-center'),

            Column::make('institute_address')
                ->title('Dirección Institución')
                ->addClass('text-center'),

            Column::make('institute_area')
                ->title('Servicio Institución')
                ->addClass('text-center'),

            Column::make('institute_city')
                ->title('Ciudad')
                ->addClass('text-center'),

            Column::make('institute_country')
                ->title('País')
                ->addClass('text-center'),

            Column::computed('action')
                ->title('Acción')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),

            Column::make('created_at')
                ->visible(false)
        ];
    }

    protected function filename(): string
    {
        return 'Institute_' . date('YmdHis');
    }
}
