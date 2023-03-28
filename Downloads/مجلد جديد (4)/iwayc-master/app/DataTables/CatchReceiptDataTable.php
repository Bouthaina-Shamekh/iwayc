<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class CatchReceiptDataTable extends DataTable
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
            ->addColumn('action', 'catchreceipt.action')
            ->addColumn('created_by', function ($tasks) {
                return $tasks->updated_by==null? $tasks->created_by:$tasks->updated_by;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('d-m-Y h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchCatchReceipt') and $request->get('searchCatchReceipt') != "") {
                    $tasks->where('catch_receipts.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('courses.courseAR', 'like', "%{$request->get('searchCatchReceipt')}%")
                                ->orWhere('students.nameAR', 'like', "%{$request->get('searchCatchReceipt')}%")
                                ->orWhere('catch_receipts.id', 'like', "%{$request->get('searchCatchReceipt')}%")
                                ->orWhere('catch_receipts.id_comp', 'like', "%{$request->get('searchCatchReceipt')}%")
                                ->orWhere('catch_receipts.date', 'like', "%{$request->get('searchCatchReceipt')}%")
                                ->orWhere('catch_receipts.amount', 'like', "%{$request->get('searchCatchReceipt')}%")
                                ->orWhere('catch_receipts.created_at', 'like binary', "%{$request->get('searchCatchReceipt')}%")
                                ->orWhere('us.name', 'like', "%{$request->get('searchCatchReceipt')}%")
                                ->orWhere('u.name', 'like', "%{$request->get('searchCatchReceipt')}%");
                        });
                }
                if ($request->has('studentId') and $request->get('studentId') != "") {
                    $tasks->where('students.id', '=', "{$request->get('studentId')}");
                }
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $tasks->where('courses.id', '=', "{$request->get('courseId')}");
                }
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('us.id', '=', "{$request->get('userId')}");
                }
                if ($request->has('fromId') and $request->has('toId') and $request->get('fromId') != "" and $request->get('toId') != "") {
                    $arrStart = explode("-", $request->get('fromId'));
                    $arrEnd = explode("-", $request->get('toId'));
                    $from = Carbon::create( $arrStart[0], $arrStart[1], $arrStart[2],0, 0, 0);
                    $to = Carbon::create( $arrEnd[0], $arrEnd[1], $arrEnd[2],23, 59, 59);
                    $tasks->whereBetween('catch_receipts.created_at',[$from,$to]);
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('catch_receipts.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->with('tot',$tasks->sum('catch_receipts.amount'));
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->leftJoin('student_course as sc', 'sc.id','=','catch_receipts.student_course_id')
            ->leftJoin('students', 'students.id','=','sc.student_id')
            ->leftJoin('courses', 'courses.id','=','sc.course_id')
            ->leftJoin('users as us', 'us.id','=','catch_receipts.created_by')
            ->leftJoin('users as u', 'u.id','=','catch_receipts.updated_by')
            ->select([ 'catch_receipts.id','catch_receipts.id_comp','catch_receipts.date','catch_receipts.m_year', 'courses.courseAR as courseAR', 'students.nameAR as studentAR', 'catch_receipts.amount', 'catch_receipts.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('catch_receipts.isdelete','=','0');
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
        return 'CatchReceipt_' . date('YmdHis');
    }
}
