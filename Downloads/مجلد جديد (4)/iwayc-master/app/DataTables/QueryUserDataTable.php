<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class QueryUserDataTable extends DataTable
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
            ->addColumn('action', 'queryuser.action')
            ->filter(function ($tasks) use ($request) {
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('users.id','=',"{$request->get('userId')}");
                }
                if ($request->has('subjectId') and $request->get('subjectId') != "") {
                    $tasks->where('query_user.subject','=',"{$request->get('subjectId')}");
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
        return $model->newQuery()->leftJoin('users', 'users.id','=','query_user.user_id')
            ->select([ 'query_user.id', 'users.name as user_id','query_user.subject','query_user.count','query_user.day1','query_user.day7','query_user.day15','query_user.day30','query_user.day60','query_user.day90','query_user.day180','query_user.last1','query_user.last2','query_user.last3']);
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
        return 'QueryUser_' . date('YmdHis');
    }
}
