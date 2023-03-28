<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class ReceiptSalaryDataTable extends DataTable
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
            ->addColumn('action', 'receiptsalary.action')
            ->addColumn('month', function ($tasks) {
                return $tasks->month."-".$tasks->year;
            })
            ->addColumn('created_by', function ($tasks) {
                return $tasks->updated_by==null? $tasks->created_by:$tasks->updated_by;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('d-m-Y h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchReceiptSalary') and $request->get('searchReceiptSalary') != "") {
                    $tasks->where('receipt_salaries.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('employees.name', 'like', "%{$request->get('searchReceiptSalary')}%")
                                ->orWhere('receipt_salaries.id', 'like', "%{$request->get('searchReceiptSalary')}%")
                                ->orWhere('receipt_salaries.id_comp', 'like', "%{$request->get('searchReceiptSalary')}%")
                                ->orWhere('receipt_salaries.date', 'like', "%{$request->get('searchReceiptSalary')}%")
                                ->orWhere('receipt_salaries.month', 'like', "%{$request->get('searchReceiptSalary')}%")
                                ->orWhere('receipt_salaries.remainder', 'like', "%{$request->get('searchReceiptSalary')}%")
                                ->orWhere('receipt_salaries.amount', 'like', "%{$request->get('searchReceiptSalary')}%")
                                ->orWhere('receipt_salaries.created_at', 'like binary', "%{$request->get('searchReceiptSalary')}%");
                        });
                }
                if ($request->has('employeeId') and $request->get('employeeId') != "") {
                    $tasks->where('employees.id', '=', "{$request->get('employeeId')}");
                }
                if ($request->has('monthId') and $request->get('monthId') != "") {
                    $tasks->where('receipt_salaries.month', '=', "{$request->get('monthId')}");
                }
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('receipt_salaries.created_by', '=', "{$request->get('userId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('receipt_salaries.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->with('tot',$tasks->sum('receipt_salaries.amount'));
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->leftJoin('employees', 'employees.id','=','receipt_salaries.employee_id')
            ->leftJoin('users as us', 'us.id','=','receipt_salaries.created_by')
            ->leftJoin('users as u', 'u.id','=','receipt_salaries.updated_by')
            ->leftJoin('salaries', 'salaries.id','=','receipt_salaries.month')
            ->select([ 'receipt_salaries.id','receipt_salaries.id_comp','receipt_salaries.date','receipt_salaries.m_year', 'employees.name as employee_id', 'salaries.month', 'salaries.year', 'receipt_salaries.remainder', 'receipt_salaries.amount', 'receipt_salaries.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('receipt_salaries.isdelete','=','0');
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
        return 'ReceiptSalary_' . date('YmdHis');
    }
}
