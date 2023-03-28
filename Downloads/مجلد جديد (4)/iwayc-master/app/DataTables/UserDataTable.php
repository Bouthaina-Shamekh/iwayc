<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
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
            ->addColumn('action', 'user.action')
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))
                    ->format('d-m-Y') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchWithdrawal') and $request->get('searchWithdrawal') != "") {
                    $tasks->where('withdrawals.isdelete', '=', '0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('courses.courseAR', 'like', "%{$request->get('searchWithdrawal')}%")
                                ->orWhere('students.nameAR', 'like', "%{$request->get('searchWithdrawal')}%")
                                ->orWhere('withdrawals.id', 'like', "%{$request->get('searchWithdrawal')}%")
                                ->orWhere('withdrawals.phone', 'like', "%{$request->get('searchWithdrawal')}%");
                        });
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('withdrawals.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->with('courseFee',$tasks->sum('withdrawals.price'))
            ->with('coursePay',$tasks->sum('withdrawals.payment'))
            ->with('courseRef',$tasks->sum('withdrawals.refund'))
            ->with('courseTea',$tasks->sum('withdrawals.teacher_fees'))
            ->with('courseWit',($tasks->sum('withdrawals.payment')-($tasks->sum('withdrawals.refund')+$tasks->sum('withdrawals.teacher_fees'))))
            ->with('courseMin',($tasks->sum('withdrawals.price')-(($tasks->sum('withdrawals.payment')-($tasks->sum('withdrawals.refund')+$tasks->sum('withdrawals.teacher_fees')))+$tasks->sum('withdrawals.teacher_fees'))));
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->leftJoin('student_course as sc', 'sc.id','=','withdrawals.student_course_id')
            ->leftJoin('students', 'students.id','=','sc.student_id')
            ->leftJoin('courses', 'courses.id','=','sc.course_id')
            ->select([ 'withdrawals.id','withdrawals.m_year', 'students.nameAR as student_id', 'withdrawals.phone', 'courses.courseAR as course_id', 'withdrawals.price', 'withdrawals.payment','withdrawals.refund','withdrawals.teacher_fees', 'withdrawals.created_at'])
            ->where('withdrawals.isdelete', '=', '0');
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
        return 'User_' . date('YmdHis');
    }
}
