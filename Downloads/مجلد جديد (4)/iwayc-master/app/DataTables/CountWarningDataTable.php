<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class CountWarningDataTable extends DataTable
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
            ->addColumn('action', 'countwarning.action')
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchCountWarning') and $request->get('searchCountWarning') != "") {
                    $tasks->where('count_warning.isdelete','=','0')
                        ->where(function ($tasks) use ($request) {
                            $tasks->where('students.nameAR', 'like', "%{$request->get('searchCountWarning')}%")
                                ->orWhere('options.title', 'like', "%{$request->get('searchCountWarning')}%")
                                ->orWhere('users.name', 'like', "%{$request->get('searchCountWarning')}%")
                                ->orWhere('count_warning.created_at', 'like binary', "%{$request->get('searchCountWarning')}%");
                        });
                }
                if ($request->has('studentId') and $request->get('studentId') != "") {
                    $tasks->where('students.id', '=', "{$request->get('studentId')}");
                }
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('users.id', '=', "{$request->get('userId')}");
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
        return $model->newQuery()->leftJoin('student_course as sc', 'sc.id','=','count_warning.student_course_id')
            ->leftJoin('courses', 'courses.id','=','sc.course_id')
            ->leftJoin('students', 'students.id','=','sc.student_id')
            ->leftJoin('options', 'options.id','=','count_warning.how_claim')
            ->leftJoin('users', 'users.id','=','count_warning.created_by')
            ->select(['count_warning.id','courses.courseAR','students.nameAR','options.title as how_claim','count_warning.notes','count_warning.isdelete','users.name as created_by','count_warning.updated_by','count_warning.created_at'])
            ->where('count_warning.isdelete','=','0');
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
        return 'CountWarning_' . date('YmdHis');
    }
}
