<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
                $btn = '<a href="' . route('admin.user.edit', ['id' => $row->id]) . '" class="edit btn btn-primary btn-sm"><i class="far fa-eye"></i></a>';
                return $btn;
            })
            ->editColumn('banned', function ($row) {
                if ($row->banned) {
                    return '<i class="fas fa-user-slash text-danger"></i>';
                }
                return '<i class="fas fa-user text-success"></i>';
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('d/m/Y H:i');
            })
            ->editColumn('level', function ($row) {
                return $row->level_label;
            })
            ->rawColumns(['action', 'banned']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
                    ->setTableId('usersdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(0);
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
            Column::make('email'),
            Column::computed('banned', 'Icona')
                ->orderable(false)
                ->exportable(false)
                ->width(60)
                ->title('Bannato')
                ->addClass('text-center'),
            Column::make('level')
                ->title('Livello utente'),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
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
        return 'Users_' . date('YmdHis');
    }
}
