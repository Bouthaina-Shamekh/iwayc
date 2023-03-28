<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class ReceiptBoxDataTable extends DataTable
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
            ->addColumn('action', 'receiptbox.action')
            ->addColumn('created_by', function ($tasks) {
                return $tasks->updated_by==null? $tasks->created_by:$tasks->updated_by;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('d-m-Y h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchReceiptBox') and $request->get('searchReceiptBox') != "") {
                    $tasks->where('receipt_boxes.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('box_expense.name', 'like', "%{$request->get('searchReceiptBox')}%")
                                ->orWhere('receipt_boxes.date', 'like', "%{$request->get('searchReceiptBox')}%")
                                ->orWhere('receipt_boxes.id', 'like', "%{$request->get('searchReceiptBox')}%")
                                ->orWhere('receipt_boxes.id_comp', 'like', "%{$request->get('searchReceiptBox')}%")
                                ->orWhere('receipt_boxes.amount', 'like', "%{$request->get('searchReceiptBox')}%")
                                ->orWhere('boxes.name', 'like', "%{$request->get('searchReceiptBox')}%")
                                ->orWhere('receipt_boxes.created_at', 'like binary', "%{$request->get('searchReceiptBox')}%");
                        });
                }
                if ($request->has('boxId') and $request->get('boxId') != "") {
                    $tasks->where('boxes.id', '=', "{$request->get('boxId')}");
                }
                if ($request->has('expenseId') and $request->get('expenseId') != "") {
                    $tasks->where('box_expense.id', '=', "{$request->get('expenseId')}");
                }
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('receipt_boxes.created_by', '=', "{$request->get('userId')}");
                }
                if ($request->has('fromId') and $request->has('toId') and $request->get('fromId') != "" and $request->get('toId') != "") {
                    $arrStart = explode("-", $request->get('fromId'));
                    $arrEnd = explode("-", $request->get('toId'));
                    $from = Carbon::create( $arrStart[0], $arrStart[1], $arrStart[2],0, 0, 0);
                    $to = Carbon::create( $arrEnd[0], $arrEnd[1], $arrEnd[2],23, 59, 59);
                    $tasks->whereBetween('receipt_boxes.created_at',[$from,$to]);
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('receipt_boxes.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->with('tot',$tasks->sum('receipt_boxes.amount'));
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->leftJoin('boxes', 'boxes.id','=','receipt_boxes.box_id')
            ->leftJoin('box_expense', 'box_expense.id','=','receipt_boxes.type')
            ->leftJoin('users as us', 'us.id','=','receipt_boxes.created_by')
            ->leftJoin('users as u', 'u.id','=','receipt_boxes.updated_by')
            ->select([ 'receipt_boxes.id','receipt_boxes.id_comp','receipt_boxes.date','receipt_boxes.m_year','boxes.name as box_id', 'box_expense.name as type', 'receipt_boxes.amount', 'receipt_boxes.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('receipt_boxes.isdelete','=','0');
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
        return 'ReceiptBox_' . date('YmdHis');
    }
}
