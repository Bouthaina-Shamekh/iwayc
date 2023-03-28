<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class RepInvRecordDataTable extends DataTable
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
            ->addColumn('action', 'repinvrecord.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->leftJoin('repositories', 'repositories.id','=','rep_inv_record.repository_id')
            ->leftJoin('users as us', 'us.id','=','rep_inv_record.user_id')
            ->leftJoin('users as u', 'u.id','=','rep_inv_record.admin_id')
            ->select([ 'rep_inv_record.id', 'repositories.name as repository_id', 'us.name as user_id', 'u.name as admin_id', 'rep_inv_record.date_inv', 'rep_inv_record.date_done', 'rep_inv_record.sum_remaind']);
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
        return 'RepInvRecord_' . date('YmdHis');
    }
}
