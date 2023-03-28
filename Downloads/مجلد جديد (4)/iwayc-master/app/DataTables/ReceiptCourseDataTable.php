<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class ReceiptCourseDataTable extends DataTable
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
            ->addColumn('action', 'receiptcourse.action')
            ->addColumn('created_by', function ($tasks) {
                return $tasks->updated_by==null? $tasks->created_by:$tasks->updated_by;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('d-m-Y h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchReceiptCourse') and $request->get('searchReceiptCourse') != "") {
                    $tasks->where('receipt_courses.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('teachers.name', 'like', "%{$request->get('searchReceiptCourse')}%")
                                ->orWhere('receipt_courses.type', 'like', "%{$request->get('searchReceiptCourse')}%")
                                ->orWhere('courses.courseAR', 'like', "%{$request->get('searchReceiptCourse')}%")
                                ->orWhere('receipt_courses.id', 'like', "%{$request->get('searchReceiptCourse')}%")
                                ->orWhere('receipt_courses.id_comp', 'like', "%{$request->get('searchReceiptCourse')}%")
                                ->orWhere('receipt_courses.date', 'like', "%{$request->get('searchReceiptCourse')}%")
                                ->orWhere('receipt_courses.teacher_ratio', 'like', "%{$request->get('searchReceiptCourse')}%")
                                ->orWhere('receipt_courses.amount', 'like', "%{$request->get('searchReceiptCourse')}%")
                                ->orWhere('receipt_courses.created_at', 'like binary', "%{$request->get('searchReceiptCourse')}%");
                        });
                }
                if ($request->has('teacherId') and $request->get('teacherId') != "") {
                    $tasks->where('teachers.id', '=', "{$request->get('teacherId')}");
                }
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $tasks->where('courses.id', '=', "{$request->get('courseId')}");
                }
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('receipt_courses.created_by', '=', "{$request->get('userId')}");
                }
                if ($request->has('fromId') and $request->has('toId') and $request->get('fromId') != "" and $request->get('toId') != "") {
                    $arrStart = explode("-", $request->get('fromId'));
                    $arrEnd = explode("-", $request->get('toId'));
                    $from = Carbon::create( $arrStart[0], $arrStart[1], $arrStart[2],0, 0, 0);
                    $to = Carbon::create( $arrEnd[0], $arrEnd[1], $arrEnd[2],23, 59, 59);
                    $tasks->whereBetween('receipt_courses.created_at',[$from,$to]);
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('receipt_courses.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->with('tot',$tasks->sum('receipt_courses.amount'));
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->leftJoin('courses', 'courses.id','=','receipt_courses.course_id')
            ->leftJoin('teachers', 'teachers.id','=','courses.teacher_id')
            ->leftJoin('users as us', 'us.id','=','receipt_courses.created_by')
            ->leftJoin('users as u', 'u.id','=','receipt_courses.updated_by')
            ->select([ 'receipt_courses.id','receipt_courses.id_comp','receipt_courses.date','receipt_courses.m_year', 'receipt_courses.type', 'teachers.name as teacher', 'courses.courseAR', 'receipt_courses.teacher_ratio', 'receipt_courses.amount', 'receipt_courses.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('receipt_courses.isdelete','=','0');
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
        return 'ReceiptCourse_' . date('YmdHis');
    }
}
