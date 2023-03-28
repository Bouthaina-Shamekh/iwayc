<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class RepsoitoryDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', 'repsoitory.action')
            ->addColumn('total', function ($tasks) {
                return $tasks->repository_in-$tasks->repository_out ;
            })
            ->editColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchRepository') and $request->get('searchRepository') != "") {
                    $tasks->where('repositories.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('boxes.name', 'like', "%{$request->get('searchRepository')}%")
                                ->orWhere('repositories.name', 'like', "%{$request->get('searchRepository')}%");
                        });
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->leftJoin('repositories_year as rp', 'rp.repository_id','=','repositories.id')
                        ->select([ 'repositories.id', 'boxes.name as box_id', 'repositories.name', 'rp.repository_out', 'rp.repository_in', 'rp.active'])
                        ->where('rp.m_year','=',"{$request->get('moneyId')}");
                }
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->leftJoin('boxes', 'boxes.id','=','repositories.box_id')
            ->select([ 'repositories.id', 'boxes.name as box_id', 'repositories.name', 'repositories.repository_out', 'repositories.repository_in', 'repositories.active'])
            ->where('repositories.isdelete','=','0');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['width' => '80px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'add your columns',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Repsoitory_' . date('YmdHis');
    }
}
