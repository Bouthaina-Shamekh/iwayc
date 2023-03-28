<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class TeacherDataTable extends DataTable
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
            ->addColumn('action', 'teacher.action')
            ->editColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))
                    ->format('d-m-Y') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchTeacher') and $request->get('searchTeacher') != "") {
                    $tasks->where('teachers.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('name', 'like', "%{$request->get('searchTeacher')}%")
                                ->orWhere('opt.title', 'like', "%{$request->get('searchTeacher')}%")
                                ->orWhere('op.title', 'like', "%{$request->get('searchTeacher')}%")
                                ->orWhere('teachers.birthday', 'like', "%{$request->get('searchTeacher')}%")
                                ->orWhere('teachers.phone1', 'like', "%{$request->get('searchTeacher')}%")
                                ->orWhere('o.title', 'like', "%{$request->get('searchTeacher')}%");
                        });
                }
                if ($request->has('specsId') and $request->get('specsId') != "") {
                    $tasks->where('opt.id', '=', "{$request->get('specsId')}");
                }
                if ($request->has('addressId') and $request->get('addressId') != "") {
                    $tasks->where('o.id', '=', "{$request->get('addressId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->leftJoin('teachers_year', 'teachers_year.teacher_id','=','teachers.id')
                        ->select(['teachers.id', 'teachers.name', 'opt.title as specialization', 'teachers.birthday', 'nationality', 'o.title as address', 'teachers.phone1', 'teachers.phone2', 'teachers.email', 'op.title as classification', 'teachers.notes', 'teachers_year.active', 'teachers.isdelete', 'teachers.created_at'])
                        ->where('teachers_year.m_year','=',$request->get('moneyId'));
                }
                if ($request->has('activeId') and $request->get('activeId') != "") {
                    $tasks->where('teachers_year.active', '=', "{$request->get('activeId')}");
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
        return $model->newQuery()->leftJoin('options as opt', 'opt.id','=','teachers.specialization')
            ->leftJoin('options as op', 'op.id','=','teachers.classification')
            ->leftJoin('options as o', 'o.id','=','teachers.address')
            ->select(['teachers.id', 'teachers.name', 'opt.title as specialization', 'teachers.birthday', 'nationality', 'o.title as address', 'teachers.phone1', 'teachers.phone2', 'teachers.email', 'op.title as classification', 'teachers.notes', 'teachers.active', 'teachers.isdelete', 'teachers.created_at'])
            ->where('teachers.isdelete','=','0');
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
        return 'Teacher_' . date('YmdHis');
    }
}
