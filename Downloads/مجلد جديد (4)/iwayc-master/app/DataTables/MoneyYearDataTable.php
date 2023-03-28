<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class MoneyYearDataTable extends DataTable
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
            ->addColumn('action', 'moneyyear.action')
            ->addColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->editColumn('start_year', function ($tasks) {
                return $tasks->start_year ? with(new Carbon($tasks->start_year))
                    ->format('d-m-Y') : '';
            })
            ->editColumn('end_year', function ($tasks) {
                return $tasks->end_year ? with(new Carbon($tasks->end_year))
                    ->format('d-m-Y') : '';
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))
                    ->format('d-m-Y') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchMoney') && $request->get('searchMoney') != "") {
                    $tasks->where('isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('money_goal', 'like', "%{$request->get('searchMoney')}%")
                                ->orWhere('first_time_balance', 'like', "%{$request->get('searchMoney')}%")
                                ->orWhere('start_year', 'like', "%{$request->get('searchMoney')}%")
                                ->orWhere('end_year', 'like', "%{$request->get('searchMoney')}%")
                                ->orWhere('created_at', 'like binary', "%{$request->get('searchMoney')}%");
                        });
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
        return $model->newQuery()->where('isdelete', 0);
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
        return 'MoneyYear_' . date('YmdHis');
    }
}
