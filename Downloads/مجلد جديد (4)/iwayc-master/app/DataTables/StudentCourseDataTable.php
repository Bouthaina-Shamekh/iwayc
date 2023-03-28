<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class StudentCourseDataTable extends DataTable
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
            ->addColumn('action', 'studentcourse.action')
            ->addColumn('pay', function ($tasks) {
                return $tasks->price - $tasks->payment;
            })
            ->addColumn('done', function ($tasks) {
                $done = '';
                $receipt = Receipt_student::where('student_course_id',$tasks->id)->where('isdelete',0)->first();
                if($receipt != null){$done = 1;}
                else{$done = 0;}
                return $done;
            })
            ->addColumn('status', function ($tasks) {
                $status = '';
                if($tasks->isdelete == 1){$status = 'محذوف';}
                elseif($tasks->iswithdrawal == 1){$status = 'منسحب';}
                else{$status = 'مسجل';}
                return $status;
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('d-m-Y') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchStudent') and $request->get('searchStudent') != "") {
                    $tasks->where('nameAR', 'like', "%{$request->get('searchStudent')}%")
                        ->orWhere('courseAR', 'like', "%{$request->get('searchStudent')}%");
                }
                if ($request->has('studentId') and $request->get('studentId') != "") {
                    $tasks->where('students.id', '=', "{$request->get('studentId')}");
                }
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $tasks->where('courses.id', '=', "{$request->get('courseId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('student_course.m_year', '=', "{$request->get('moneyId')}");
                }
                if ($request->has('statusId') and $request->get('statusId') != "") {
                    if ($request->get('statusId') == 1){
                        $tasks->where('student_course.iswithdrawal', '=', "1")
                            ->where('student_course.isdelete', '=', "0");
                    }elseif ($request->get('statusId') == 2){
                        $tasks->where('student_course.isdelete', '=', "1");
                    }else{
                        $tasks->where('student_course.isdelete', '=', "0")
                            ->where('student_course.iswithdrawal', '=', "0");
                    }
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
        return $model->newQuery()->leftJoin('students', 'students.id','=','student_course.student_id')
            ->leftJoin('courses', 'courses.id','=','student_course.course_id')
            ->leftJoin('withdrawals', 'withdrawals.student_course_id','=','student_course.id')
            ->select(['student_course.id','withdrawals.refund','student_course.m_year', 'courses.courseAR', 'students.nameAR', 'student_course.price', 'student_course.payment', 'student_course.isdelete', 'student_course.iswithdrawal', 'student_course.created_at']);
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
        return 'StudentCourse_' . date('YmdHis');
    }
}
