<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class CatchReceiptBoxDataTable extends DataTable
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
            ->addColumn('action', 'catchreceiptbox.action')
            ->addColumn('created_by', function ($tasks) {
                return $tasks->updated_by==null? $tasks->created_by:$tasks->updated_by;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))
                    ->format('d-m-Y h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchCatchReceiptBox') and $request->get('searchCatchReceiptBox') != "") {
                    $tasks->where('catch_receipt_boxes.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('box_income.name', 'like', "%{$request->get('searchCatchReceiptBox')}%")
                                ->orWhere('catch_receipt_boxes.customer', 'like', "%{$request->get('searchCatchReceiptBox')}%")
                                ->orWhere('catch_receipt_boxes.id', 'like', "%{$request->get('searchCatchReceiptBox')}%")
                                ->orWhere('catch_receipt_boxes.id_comp', 'like', "%{$request->get('searchCatchReceiptBox')}%")
                                ->orWhere('catch_receipt_boxes.date', 'like', "%{$request->get('searchCatchReceiptBox')}%")
                                ->orWhere('catch_receipt_boxes.count', 'like', "%{$request->get('searchCatchReceiptBox')}%")
                                ->orWhere('boxes.name', 'like', "%{$request->get('searchCatchReceiptBox')}%")
                                ->orWhere('catch_receipt_boxes.amount', 'like', "%{$request->get('searchCatchReceiptBox')}%")
                                ->orWhere('catch_receipt_boxes.created_at', 'like binary', "%{$request->get('searchCatchReceiptBox')}%");
                        });
                }
                if ($request->has('boxId') and $request->get('boxId') != "") {
                    $tasks->where('boxes.id', '=', "{$request->get('boxId')}");
                }
                if ($request->has('incomeId') and $request->get('incomeId') != "") {
                    $tasks->where('box_income.id', '=', "{$request->get('incomeId')}");
                }
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('catch_receipt_boxes.created_by', '=', "{$request->get('userId')}");
                }
                if ($request->has('fromId') and $request->has('toId') and $request->get('fromId') != "" and $request->get('toId') != "") {
                    $arrStart = explode("-", $request->get('fromId'));
                    $arrEnd = explode("-", $request->get('toId'));
                    $from = Carbon::create( $arrStart[0], $arrStart[1], $arrStart[2],0, 0, 0);
                    $to = Carbon::create( $arrEnd[0], $arrEnd[1], $arrEnd[2],23, 59, 59);
                    $tasks->whereBetween('catch_receipt_boxes.created_at',[$from,$to]);
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('catch_receipt_boxes.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->with('tot',$tasks->sum('catch_receipt_boxes.amount'));
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->leftJoin('boxes', 'boxes.id','=','catch_receipt_boxes.box_id')
            ->leftJoin('box_income', 'box_income.id','=','catch_receipt_boxes.type')
            ->leftJoin('users as us', 'us.id','=','catch_receipt_boxes.created_by')
            ->leftJoin('users as u', 'u.id','=','catch_receipt_boxes.updated_by')
            ->select([ 'catch_receipt_boxes.id','catch_receipt_boxes.id_comp','catch_receipt_boxes.date','catch_receipt_boxes.m_year','boxes.name as box_id', 'box_income.name as type', 'catch_receipt_boxes.customer', 'catch_receipt_boxes.count', 'catch_receipt_boxes.amount', 'catch_receipt_boxes.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('catch_receipt_boxes.isdelete','=','0');
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
        return 'CatchReceiptBox_' . date('YmdHis');
    }
}
