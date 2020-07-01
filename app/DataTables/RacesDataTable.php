<?php

namespace App\DataTables;

use App\Models\Race;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RacesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.race.edit', ['id' => $row->id]) . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i> </a>';
                    return $btn;
            })
            ->addColumn('icon_image', function ($row) {
                if(!is_null($row->icon_url)){
                 return '<img class="img-fluid" src="' . $row->icon_url . '" >';
                }
                return null;
            })
            ->rawColumns(['icon_image', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Race $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Race $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('races-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(0, 'asc');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::computed('icon_image', 'Icona')
                ->orderable(false)
                ->exportable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('name'),
            Column::make('character_number')
            ->orderable(false)
            ->searchable(false)
            ->title('Personaggi'),
            Column::computed('action')
                ->orderable(false)
                ->exportable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Races_' . date('YmdHis');
    }
}
