<?php

namespace App\DataTables;

use App\Models\Absence_s;
use Yajra\DataTables\Services\DataTable;

class AbsenceSDataTable extends DataTable
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
            ->addColumn('action', 'absences.action')
            ->editColumn('created_by', function ($tasks) {
                return $tasks->updated_by?$tasks->updated_by:$tasks->created_by;
            })
            ->editColumn('type', function ($tasks) {
                return $tasks->type ? 'تأخير' : 'غياب';
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('d-m-Y') : '';
            })
            ->filter(function ($tasks) {
                if ($this->request()->has('search_h') and $this->request()->get('search_h') != "") {
                    $tasks->where('absences_s.isdelete','=','0')
                        ->where(function ($tasks) {
                            $keyword = $this->request()->get('search_h');
                            $tasks->where('students.nameAR', 'like', "%{$keyword}%")
                                ->orWhere('us.name', 'like', "%{$keyword}%")
                                ->orWhere('u.name', 'like', "%{$keyword}%")
                                ->orWhere('courses.courseAR', 'like', "%{$keyword}%");
                        });
                }
                if ($this->request()->has('studentId') and $this->request()->get('studentId') != "") {
                    $tasks->where('students.id', '=', "{$this->request()->get('studentId')}");
                }
                if ($this->request()->has('courseId') and $this->request()->get('courseId') != "") {
                    $tasks->where('courses.id', '=', "{$this->request()->get('courseId')}");
                }
                if ($this->request()->has('typeId') and $this->request()->get('typeId') != "") {
                    $tasks->where('absences_s.type', '=', "{$this->request()->get('typeId')}");
                }
                if ($this->request()->has('moneyId') and $this->request()->get('moneyId') != "") {
                    $tasks->where('absences_s.m_year', '=', "{$this->request()->get('moneyId')}");
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
        return $model->newQuery()->leftJoin('student_course', 'student_course.id','=','absences_s.student_course_id')
            ->leftJoin('courses', 'courses.id','=','student_course.course_id')
            ->leftJoin('students', 'students.id','=','student_course.student_id')
            ->leftJoin('users as us', 'us.id','=','absences_s.created_by')
            ->leftJoin('users as u', 'u.id','=','absences_s.updated_by')
            ->select([ 'absences_s.id','absences_s.date','absences_s.m_year', 'students.nameAR as student_id', 'courses.courseAR as course_id', 'absences_s.type', 'absences_s.delay_time', 'absences_s.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('absences_s.isdelete','=','0');
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
            'date',
            'student_id',
            'course_id',
            'type',
            'delay_time',
            'created_by',
            'created_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'AbsenceS_' . date('YmdHis');
    }
}
