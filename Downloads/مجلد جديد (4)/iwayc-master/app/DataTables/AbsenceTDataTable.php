<?php

namespace App\DataTables;

use App\Models\Absence_t;
use Yajra\DataTables\Services\DataTable;

class AbsenceTDataTable extends DataTable
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
            ->addColumn('action', 'absencet.action')
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
                if ($this->request()->has('searchAbsence') and $this->request()->get('searchAbsence') != "") {
                    $tasks->where('absences_t.isdelete','=','0')
                        ->where(function ($tasks){
                            $keyword = $this->request()->get('search_h');
                            $tasks->where('teachers.name', 'like', "%{$keyword}%")
                                ->orWhere('us.name', 'like', "%{$keyword}%")
                                ->orWhere('u.name', 'like', "%{$keyword}%")
                                ->orWhere('courses.courseAR', 'like', "%{$keyword}%");
                        });
                }
                if ($this->request()->has('teacherId') and $this->request()->get('teacherId') != "") {
                    $tasks->where('students.id', '=', "{$this->request()->get('teacherId')}");
                }
                if ($this->request()->has('courseId') and $this->request()->get('courseId') != "") {
                    $tasks->where('courses.id', '=', "{$this->request()->get('courseId')}");
                }
                if ($this->request()->has('typeId') and $this->request()->get('typeId') != "") {
                    $tasks->where('absences_t.type', '=', "{$this->request()->get('typeId')}");
                }
                if ($this->request()->has('moneyId') and $this->request()->get('moneyId') != "") {
                    $tasks->where('absences_t.m_year', '=', "{$this->request()->get('moneyId')}");
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
        return $model->newQuery()->leftJoin('courses', 'courses.id','=','absences_t.course_id')
            ->leftJoin('teachers', 'teachers.id','=','courses.teacher_id')
            ->leftJoin('users as us', 'us.id','=','absences_t.created_by')
            ->leftJoin('users as u', 'u.id','=','absences_t.updated_by')
            ->select([ 'absences_t.id','absences_t.m_year','absences_t.date', 'teachers.name as teacher_id', 'courses.courseAR as course_id', 'absences_t.type', 'absences_t.delay_time', 'absences_t.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('absences_t.isdelete','=','0');
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
            'teacher_id',
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
        return 'AbsenceT_' . date('YmdHis');
    }
}
