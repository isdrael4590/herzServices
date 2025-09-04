<?php

namespace Modules\ConfigurateBase\DataTables;

use Modules\ConfigurateBase\Entities\CompanySites;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CompanySitesDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('parent_company_sites', function ($data) {
                if ($data->parentCompanySites) {
                    return '<span class="badge bg-secondary">' . $data->parentCompanySites->name . '</span>';
                }
                return '<span class="text-muted">Sin padre</span>';
            })
            ->addColumn('action', function ($data) {
                return view('configuratebase::CompanySites.partials.actions', compact('data'));
            })
            ->addColumn('status', function ($data) {
                if ($data->status == 'active') {
                    $html = '<span class="badge bg-success"><i class="bi bi-check-circle"></i> Activo</span>';
                } else {
                    $html = '<span class="badge bg-secondary"><i class="bi bi-x-circle"></i> Inactivo</span>';
                }
                return $html;
            })
            ->addColumn('company_sites_info', function ($data) {
                $info = '';
                if ($data->city || $data->country) {
                    $info .= '<small class="text-muted">';
                    if ($data->city) {
                        $info .= '<i class="bi bi-geo-alt"></i> ' . $data->city;
                        if ($data->country) {
                            $info .= ', ';
                        }
                    }
                    if ($data->country) {
                        $info .= $data->country;
                    }
                    $info .= '</small>';
                }
                return $info ?: '<span class="text-muted">-</span>';
            })
            ->addColumn('children_count', function ($data) {
                $count = $data->childcompany_sites->count();
                if ($count > 0) {
                    return '<span class="badge bg-info">' . $count . ' hija(s)</span>';
                }
                return '<span class="text-muted">0</span>';
            })
            ->addColumn('code_formatted', function ($data) {
                return '<code class="bg-light px-2 py-1 rounded">' . $data->code . '</code>';
            })
            ->addColumn('name_with_description', function ($data) {
                $html = '<strong>' . $data->name . '</strong>';
                if ($data->description) {
                    $html .= '<br><small class="text-muted">' . \Str::limit($data->description, 50) . '</small>';
                }
                return $html;
            })
            ->rawColumns(['parent_company_sites', 'status', 'company_sites_info', 'children_count', 'code_formatted', 'name_with_description', 'action']);
    }

    public function query(CompanySites $model)
    {
        return $model->newQuery()
            ->with(['parentCompanySites:id,name', 'childcompany_sites:id,parent_company_sites_id'])
            ->select([
                'id',
                'name',
                'code',
                'description',
                'city',
                'country',
                'address', // Agregar si existe en tu BD
                'parent_company_sites_id',
                'status',
                'created_at',
                'updated_at'
            ]);
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('company_sites-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                 'tr' .
                 <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->orderBy(1) // Ordenar por nombre
            ->buttons(
                Button::make('create')
                    ->text('<i class="bi bi-plus-circle"></i> Nueva Ubicación')
                    ->className('btn btn-primary btn-sm')
                    ->action('window.location.href="' . route('company_sites.create') . '"'), // Corregido
                Button::make('excel')
                    ->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel')
                    ->className('btn btn-success btn-sm'),
                Button::make('pdf')
                    ->text('<i class="bi bi-file-earmark-pdf-fill"></i> PDF')
                    ->className('btn btn-danger btn-sm'),
                Button::make('print')
                    ->text('<i class="bi bi-printer-fill"></i> Imprimir')
                    ->className('btn btn-info btn-sm'),
                Button::make('reset')
                    ->text('<i class="bi bi-x-circle"></i> Limpiar')
                    ->className('btn btn-secondary btn-sm'),
                Button::make('reload')
                    ->text('<i class="bi bi-arrow-repeat"></i> Actualizar')
                    ->className('btn btn-outline-primary btn-sm')
            )
            ->parameters([
                'responsive' => true,
                'autoWidth' => false,
                'language' => [
                    'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
                ]
            ]);
    }

    protected function getColumns()
    {
        return [
            Column::computed('code_formatted')
                ->name('code')
                ->title('Código')
                ->className('text-center align-middle')
                ->width('100px'),
            Column::computed('name_with_description')
                ->name('name')
                ->title('Nombre')
                ->className('align-middle')
                ->width('250px'),
            Column::computed('parent_company_sites')
                ->title('Ubicación Padre')
                ->className('text-center align-middle')
                ->width('150px'),
            Column::make('city')
                ->title('Ciudad')
                ->className('text-center align-middle')
                ->width('150px'),
            Column::make('country')
                ->title('País')
                ->className('text-center align-middle')
                ->width('150px'),
            Column::make('address')
                ->title('Dirección')
                ->className('text-center align-middle')
                ->width('120px'),
            Column::computed('status')
                ->title('Estado')
                ->className('text-center align-middle')
                ->width('100px'),
            Column::computed('action')
                ->title('Acciones')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle')
                ->width('150px'),
            Column::make('created_at')
                ->title('Fecha Creación')
                ->visible(false)
                ->className('text-center align-middle'),
            Column::make('updated_at')
                ->title('Última Actualización')
                ->visible(false)
                ->className('text-center align-middle')
        ];
    }

    protected function filename(): string
    {
        return 'Ubicaciones_' . date('YmdHis');
    }
}