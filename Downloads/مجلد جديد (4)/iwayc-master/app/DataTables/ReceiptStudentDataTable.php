<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class ReceiptStudentDataTable extends DataTable
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
            ->addColumn('action', 'receiptstudent.action')
            ->addColumn('created_by', function ($tasks) {
                return $tasks->updated_by==null? $tasks->created_by:$tasks->updated_by;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('d-m-Y h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchReceiptStudent') and $request->get('searchReceiptStudent') != "") {
                    $tasks->where('receipt_students.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('students.nameAR', 'like', "%{$request->get('searchReceiptStudent')}%")
                                ->orWhere('courses.courseAR', 'like', "%{$request->get('searchReceiptStudent')}%")
                                ->orWhere('receipt_students.id', 'like', "%{$request->get('searchReceiptStudent')}%")
                                ->orWhere('receipt_students.id_comp', 'like', "%{$request->get('searchReceiptStudent')}%")
                                ->orWhere('receipt_students.date', 'like', "%{$request->get('searchReceiptStudent')}%")
                                ->orWhere('receipt_students.amount', 'like', "%{$request->get('searchReceiptStudent')}%")
                                ->orWhere('receipt_students.created_at', 'like binary', "%{$request->get('searchReceiptStudent')}%");
                        });
                }
                if ($request->has('studentId') and $request->get('studentId') != "") {
                    $tasks->where('students.id', '=', "{$request->get('studentId')}");
                }
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $tasks->where('courses.id', '=', "{$request->get('courseId')}");
                }
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('receipt_students.created_by', '=', "{$request->get('userId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('receipt_students.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->with('tot',$tasks->sum('receipt_students.amount'));
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->leftJoin('student_course', 'student_course.id','=','receipt_students.student_course_id')
            ->leftJoin('courses', 'courses.id','=','student_course.course_id')
            ->leftJoin('students', 'students.id','=','student_course.student_id')
            ->leftJoin('teachers', 'teachers.id','=','courses.teacher_id')
            ->leftJoin('users as us', 'us.id','=','receipt_students.created_by')
            ->leftJoin('users as u', 'u.id','=','receipt_students.updated_by')
            ->select([ 'receipt_students.id','receipt_students.id_comp','receipt_students.date','receipt_students.m_year', 'teachers.name as teacherAR', 'students.nameAR as studentAR', 'courses.courseAR', 'receipt_students.amount', 'receipt_students.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('receipt_students.isdelete','=','0');
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
        return 'ReceiptStudent_' . date('YmdHis');
    }
}
