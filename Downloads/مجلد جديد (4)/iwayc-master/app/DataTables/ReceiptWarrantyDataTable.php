<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class ReceiptWarrantyDataTable extends DataTable
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
            ->addColumn('action', 'receiptwarranty.action')
            ->addColumn('created_by', function ($tasks) {
                return $tasks->updated_by==null? $tasks->created_by:$tasks->updated_by;
            })
            ->editColumn('monthYear', function ($tasks) {
                return $tasks->month."-".$tasks->year;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('d-m-Y h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchReceiptWarranty') and $request->get('searchReceiptWarranty') != "") {
                    $tasks->where('receipt_warranties.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('salaries.salary', 'like', "%{$request->get('searchReceiptWarranty')}%")
                                ->orWhere('employees.name', 'like', "%{$request->get('searchReceiptWarranty')}%")
                                ->orWhere('receipt_warranties.id', 'like', "%{$request->get('searchReceiptWarranty')}%")
                                ->orWhere('receipt_warranties.id_comp', 'like', "%{$request->get('searchReceiptWarranty')}%")
                                ->orWhere('receipt_warranties.date', 'like', "%{$request->get('searchReceiptWarranty')}%")
                                ->orWhere('salaries.month', 'like', "%{$request->get('searchReceiptWarranty')}%")
                                ->orWhere('receipt_warranties.amount', 'like', "%{$request->get('searchReceiptWarranty')}%")
                                ->orWhere('receipt_warranties.created_at', 'like binary', "%{$request->get('searchReceiptWarranty')}%");
                        });
                }
                if ($request->has('employeeId') and $request->get('employeeId') != "") {
                    $tasks->where('employees.id', '=', "{$request->get('employeeId')}");
                }
                if ($request->has('monthId') and $request->get('monthId') != "") {
                    $tasks->where('salaries.month', '=', "{$request->get('monthId')}");
                }
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('receipt_warranties.created_by', '=', "{$request->get('userId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('receipt_warranties.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->with('tot',$tasks->sum('receipt_warranties.amount'));
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->leftJoin('salaries', 'salaries.id','=','receipt_warranties.salary_id')
            ->leftJoin('employees', 'employees.id','=','salaries.employee_id')
            ->leftJoin('users as us', 'us.id','=','receipt_warranties.created_by')
            ->leftJoin('users as u', 'u.id','=','receipt_warranties.updated_by')
            ->select([ 'receipt_warranties.id','receipt_warranties.id_comp','receipt_warranties.date','receipt_warranties.m_year', 'employees.name as employee_id', 'salaries.month', 'salaries.year', 'salaries.salary_warranty as salary_id', 'receipt_warranties.amount', 'receipt_warranties.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('receipt_warranties.isdelete','=','0');
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
        return 'ReceiptWarranty_' . date('YmdHis');
    }
}
