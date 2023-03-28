<?php

namespace App\DataTables;

use App\Models\Campaign;
use Carbon\Carbon;
use Yajra\DataTables\Services\DataTable;

class CampaignDataTable extends DataTable
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
            ->addColumn('action', 'campaign.action')->editColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))
                    ->format('d-m-Y') : '';
            })
            ->editColumn('created_by', function ($tasks) {
                return $tasks->updated_by ? $tasks->updated_by : $tasks->created_by;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Campaign $model)
    {
        return $model->newQuery()->leftJoin('users as us', 'us.id','=','campaigns.created_by')
            ->leftJoin('users as u', 'u.id','=','campaigns.updated_by')
            ->select([ 'campaigns.id',  'campaigns.title',  'campaigns.start',  'campaigns.active', 'campaigns.created_at', 'us.name as created_by', 'u.name as updated_by', 'campaigns.isdelete'])
            ->where('campaigns.isdelete','=','0');
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
        return 'Campaign_' . date('YmdHis');
    }
}
