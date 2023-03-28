<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class ReceiptRewardDataTable extends DataTable
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
            ->addColumn('action', 'receiptreward.action')
            ->addColumn('created_by', function ($tasks) {
                return $tasks->updated_by==null? $tasks->created_by:$tasks->updated_by;
            })
            ->editColumn('type', function ($tasks) {
                return $tasks->type==0?'مكافأت':'خصومات';
            })
            ->editColumn('created_by', function ($tasks) {
                return $tasks->created_by==null?'لا يوجد':$tasks->created_by;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('d-m-Y h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchReceiptReward') and $request->get('searchReceiptReward') != "") {
                    $tasks->where('receipt_rewards.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('options.title', 'like', "%{$request->get('searchReceiptReward')}%")
                                ->orWhere('employees.name', 'like', "%{$request->get('searchReceiptReward')}%")
                                ->orWhere('receipt_rewards.id', 'like', "%{$request->get('searchReceiptReward')}%")
                                ->orWhere('receipt_rewards.id_comp', 'like', "%{$request->get('searchReceiptReward')}%")
                                ->orWhere('receipt_rewards.date', 'like', "%{$request->get('searchReceiptReward')}%")
                                ->orWhere('receipt_rewards.receipts_rewards', 'like', "%{$request->get('searchReceiptReward')}%")
                                ->orWhere('receipt_rewards.amount', 'like', "%{$request->get('searchReceiptReward')}%")
                                ->orWhere('receipt_rewards.created_at', 'like binary', "%{$request->get('searchReceiptReward')}%");
                        });
                }
                if ($request->has('employeeId') and $request->get('employeeId') != "") {
                    $tasks->where('employees.id', '=', "{$request->get('employeeId')}");
                }
                if ($request->has('monthId') and $request->get('monthId') != "") {
                    $tasks->where('receipt_rewards.receipts_rewards', '=', "{$request->get('monthId')}");
                }
                if ($request->has('typeId') and $request->get('typeId') != "") {
                    $tasks->where('receipt_rewards.type', '=', "{$request->get('typeId')}");
                }
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('receipt_rewards.created_by', '=', "{$request->get('userId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('receipt_rewards.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->with('tot',$tasks->sum('receipt_rewards.amount'));
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->leftJoin('employees', 'employees.id','=','receipt_rewards.employee_id')
            ->leftJoin('options', 'options.id','=','receipt_rewards.type')
            ->leftJoin('users as us', 'us.id','=','receipt_rewards.created_by')
            ->leftJoin('users as u', 'u.id','=','receipt_rewards.updated_by')
            ->select([ 'receipt_rewards.id','receipt_rewards.id_comp','receipt_rewards.date','receipt_rewards.m_year', 'employees.name as employee_id', 'receipt_rewards.type', 'receipt_rewards.receipts_rewards', 'receipt_rewards.amount', 'receipt_rewards.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('receipt_rewards.isdelete','=','0');
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
        return 'ReceiptReward_' . date('YmdHis');
    }
}
