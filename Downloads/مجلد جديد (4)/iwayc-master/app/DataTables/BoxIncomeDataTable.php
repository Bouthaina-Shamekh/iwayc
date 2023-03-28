<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class BoxIncomeDataTable extends DataTable
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
            ->addColumn('action', 'boxincome.action')
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('d-m-Y h:i') : '';
            })
            ->filter(function ($tasks) use ($request,$id) {
                if ($request->has('searchBoxExpense') and $request->get('searchBoxExpense') != "") {
                    $tasks->where('box_expense.isdelete','=','0')
                        ->where('box_expense.box_id','=',$id)
                        ->where(function ($tasks) use ($request){
                            $tasks->where('box_expense.name', 'like', "%{$request->get('searchBoxExpense')}%")
                                ->orWhere('box_expense.created_at', 'like binary', "%{$request->get('searchBoxExpense')}%");
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
        return $model->newQuery()->leftJoin('boxes', 'boxes.id','=','box_expense.box_id')
            ->select(['box_expense.id', 'box_expense.name', 'boxes.name as box_id', 'box_expense.created_at'])
            ->where('box_expense.isdelete','=','0')
            ->where('box_expense.box_id','=',$id);
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
        return 'BoxIncome_' . date('YmdHis');
    }
}
