<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class StudentDataTable extends DataTable
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
            ->addColumn('action', 'student.action')
            ->editColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('d-m-Y') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchStudent') and $request->get('searchStudent') != "") {
                    $tasks->where('students.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('nameAR', 'like', "%{$request->get('searchStudent')}%")
                                ->orWhere('opt.title', 'like', "%{$request->get('searchStudent')}%")
                                ->orWhere('op.title', 'like', "%{$request->get('searchStudent')}%")
                                ->orWhere('students.birthday', 'like', "%{$request->get('searchStudent')}%")
                                ->orWhere('students.phone1', 'like', "%{$request->get('searchStudent')}%")
                                ->orWhere('students.whatsup', 'like', "%{$request->get('searchStudent')}%")
                                ->orWhere('o.title', 'like', "%{$request->get('searchStudent')}%");
                        });
                }
                if ($request->has('classId') and $request->get('classId') != "") {
                    $tasks->where('op.id', '=', "{$request->get('classId')}");
                }
                if ($request->has('addressId') and $request->get('addressId') != "") {
                    $tasks->where('o.id', '=', "{$request->get('addressId')}");
                }
                if ($request->has('levelId') and $request->get('levelId') != "") {
                    $tasks->where('opt.id', '=', "{$request->get('levelId')}");
                }
                if ($request->has('genderId') and $request->get('genderId') != "") {
                    $tasks->where('oo.id', '=', "{$request->get('genderId')}");
                }
                if ($request->has('activeId') and $request->get('activeId') != "") {
                    $tasks->where('students_year.active','=',$request->get('activeId'));
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->leftJoin('students_year', 'students_year.student_id','=','students.id')
                        ->select(['students.id', 'students.nameAR', 'students.birthday', 'oo.title as gender', 'o.title as address', 'students.phone1', 'students.whatsup', 'opt.title as level', 'op.title as classification', 'students_year.active', 'students.created_at'])
                        ->where('students_year.m_year','=',$request->get('moneyId'));
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
        return $model->newQuery()->leftJoin('options as opt', 'opt.id','=','students.level')
            ->leftJoin('options as op', 'op.id','=','students.classification')
            ->leftJoin('options as o', 'o.id','=','students.address')
            ->leftJoin('options as oo', 'oo.id','=','students.gender')
            ->select(['students.id', 'students.nameAR', 'students.birthday', 'oo.title as gender', 'o.title as address', 'students.phone1', 'students.whatsup', 'opt.title as level', 'op.title as classification', 'students.active', 'students.created_at'])
            ->where('students.isdelete','=','0')->orderBy("id","DESC");
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
        return 'Student_' . date('YmdHis');
    }
}
