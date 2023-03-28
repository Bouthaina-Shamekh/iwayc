<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class ReceiptAdvanceDataTable extends DataTable
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
            ->addColumn('action', 'receiptadvance.action')
            ->addColumn('created_by', function ($tasks) {
                return $tasks->updated_by==null? $tasks->created_by:$tasks->updated_by;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('d-m-Y h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchReceiptAdvance') and $request->get('searchReceiptAdvance') != "") {
                    $tasks->where('receipt_advances.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('receipt_advances.id', 'like', "%{$request->get('searchReceiptAdvance')}%")
                                ->orWhere('receipt_advances.id_comp', 'like', "%{$request->get('searchReceiptAdvance')}%")
                                ->orWhere('receipt_advances.date', 'like', "%{$request->get('searchReceiptAdvance')}%")
                                ->orWhere('employees.name', 'like', "%{$request->get('searchReceiptAdvance')}%")
                                ->orWhere('receipt_advances.advance_payment', 'like', "%{$request->get('searchReceiptAdvance')}%")
                                ->orWhere('receipt_advances.month_count', 'like', "%{$request->get('searchReceiptAdvance')}%")
                                ->orWhere('receipt_advances.month_payment', 'like', "%{$request->get('searchReceiptAdvance')}%")
                                ->orWhere('receipt_advances.start_payment', 'like', "%{$request->get('searchReceiptAdvance')}%")
                                ->orWhere('receipt_advances.created_at', 'like binary', "%{$request->get('searchReceiptAdvance')}%");
                        });
                }
                if ($request->has('employeeId') and $request->get('employeeId') != "") {
                    $tasks->where('employees.id', '=', "{$request->get('employeeId')}");
                }
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('receipt_advances.created_by', '=', "{$request->get('userId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('receipt_advances.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->with('tot',$tasks->sum('receipt_advances.advance_payment'));
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->leftJoin('employees', 'employees.id','=','receipt_advances.employee_id')
            ->leftJoin('users as us', 'us.id','=','receipt_advances.created_by')
            ->leftJoin('users as u', 'u.id','=','receipt_advances.updated_by')
            ->select([ 'receipt_advances.id','receipt_advances.id_comp','receipt_advances.date','receipt_advances.m_year', 'employees.name as employee_id', 'receipt_advances.advance_payment', 'receipt_advances.month_count', 'receipt_advances.month_payment', 'receipt_advances.start_payment', 'receipt_advances.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('receipt_advances.isdelete','=','0');
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
        return 'ReceiptAdvance_' . date('YmdHis');
    }
}
