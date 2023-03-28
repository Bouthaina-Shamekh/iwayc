<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class CourseDataTable extends DataTable
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
            ->addColumn('action', 'course.action')
            ->editColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->editColumn('ratio', function ($tasks) {
                return $tasks->ratio . " %";
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))
                    ->format('d-m-Y') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchCourse') and $request->get('searchCourse') != "") {
                    $tasks->where('courses.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('teachers.name', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.courseAR', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.total_withdrawn_student', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.course_time', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.total_fees', 'like', "%{$request->get('searchCourse')}%")
                                ->orWhere('courses.total_reg_student', 'like', "%{$request->get('searchCourse')}%");
                        });
                }
                if ($request->has('teacherId') and $request->get('teacherId') != "") {
                    $tasks->where('teachers.id', '=', "{$request->get('teacherId')}");
                }
                if ($request->has('activeId') and $request->get('activeId') != "") {
                    $tasks->where('courses.active', '=', "{$request->get('activeId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('courses.m_year', '=', "{$request->get('moneyId')}");
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
        return $model->newQuery()->leftJoin('teachers', 'teachers.id','=','courses.teacher_id')
            ->select([ 'courses.id',  'courses.m_year',  'courses.courseAR','courses.ratio_type','courses.ratio',  'courses.total_withdrawn_student',  'courses.course_time', 'teachers.name as teacher_id',  'courses.total_fees',  'courses.total_reg_student',  'courses.active', 'courses.created_at', 'courses.isdelete'])
            ->where('courses.isdelete','=','0');
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
        return 'Course_' . date('YmdHis');
    }
}
