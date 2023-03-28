<?php

namespace App\DataTables;

use App\Task;
use Yajra\DataTables\Services\DataTable;

class TaskDataTable extends DataTable
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
            ->addColumn('action', 'task.action')
            ->editColumn('active', function ($tasks) {
                return $tasks->active==1?'فعال':'غير فعال';
            })
            ->filter(function ($tasks) {
                if ($this->request()->has('search_h') and $this->request()->get('search_h') != "") {
                    $keyword = $this->request()->get('search_h');
                    $tasks->where('us.name', 'like', "%{$keyword}%")
                        ->orWhere('u.name', 'like', "%{$keyword}%")
                        ->orWhere('tasks.title', 'like', "%{$keyword}%")
                        ->orWhere('options.title', 'like', "%{$keyword}%");
                };/*
                if ($this->request()->has('search')['value'] and $this->request()->get('search')['value'] != "") {
                    $keyword = $this->request()->get('search')['value'];
                    $tasks->where('us.name', 'like', "%{$keyword}%")
                        ->orWhere('u.name', 'like', "%{$keyword}%")
                        ->orWhere('tasks.title', 'like', "%{$keyword}%")
                        ->orWhere('options.title', 'like', "%{$keyword}%");
                };*/
                if ($this->request()->has('active_h') and $this->request()->get('active_h') != "") {
                    $keyword = $this->request()->get('active_h');
                    $tasks->where('tasks.active', '=', $keyword);
                };
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Task $model)
    {
        return $model->newQuery()->leftJoin('users as us', 'us.id','=','tasks.sender')
            ->leftJoin('users as u', 'u.id','=','tasks.receiver')
            ->leftJoin('options', 'options.id','=','tasks.category')
            ->select(['tasks.id', 'us.name as sender', 'u.name as receiver', 'tasks.title', 'options.title as category', 'tasks.start_date', 'tasks.end_date', 'tasks.active', 'tasks.reminders_num', 'tasks.evaluate', 'tasks.created_at', 'tasks.updated_at'])
            ->where('tasks.isdelete','=','0')
            ->where('tasks.end_date','=',null);
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
            'sender',
            'receiver',
            'title',
            'category',
            'start_date',
            'end_date',
            'reminders_num',
            'active',
            'evaluate',
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
        return 'Task_' . date('YmdHis');
    }
}
