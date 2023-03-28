<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class QuotaDataTable extends DataTable
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
            ->addColumn('action', 'quota.action')
            ->addColumn('created_by', function ($tasks) {
                return $tasks->updated_by==null? $tasks->created_by:$tasks->updated_by;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('d-m-Y h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchQuota') and $request->get('searchQuota') != "") {
                    $tasks->where('quota.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('courses.courseAR', 'like', "%{$request->get('searchQuota')}%")
                                ->orWhere('teachers.name', 'like', "%{$request->get('searchQuota')}%")
                                ->orWhere('opti.title', 'like', "%{$request->get('searchQuota')}%")
                                ->orWhere('opt.title', 'like', "%{$request->get('searchQuota')}%")
                                ->orWhere('op.title', 'like', "%{$request->get('searchQuota')}%")
                                ->orWhere('o.title', 'like', "%{$request->get('searchQuota')}%")
                                ->orWhere('oo.title', 'like', "%{$request->get('searchQuota')}%")
                                ->orWhere('quota.created_at', 'like binary', "%{$request->get('searchQuota')}%")
                                ->orWhere('us.name', 'like', "%{$request->get('searchQuota')}%")
                                ->orWhere('u.name', 'like', "%{$request->get('searchQuota')}%");
                        });
                }
                if ($request->has('dayId') and $request->get('dayId') != "") {
                    $tasks->where('opti.id', '=', "{$request->get('dayId')}");
                }
                if ($request->has('roomId') and $request->get('roomId') != "") {
                    $tasks->where('opt.id', '=', "{$request->get('roomId')}");
                }
                if ($request->has('typeId') and $request->get('typeId') != "") {
                    $tasks->where('op.id', '=', "{$request->get('typeId')}");
                }
                if ($request->has('timeId') and $request->get('timeId') != "") {
                    $tasks->where('o.id', '=', "{$request->get('timeId')}");
                }
                if ($request->has('timeToId') and $request->get('timeToId') != "") {
                    $tasks->where('oo.id', '=', "{$request->get('timeToId')}");
                }
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $tasks->where('courses.id', '=', "{$request->get('courseId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('quota.m_year', '=', "{$request->get('moneyId')}");
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
        return $model->newQuery()->leftJoin('options as opti', 'opti.id','=','quota.day')
            ->leftJoin('options as opt', 'opt.id','=','quota.room')
            ->leftJoin('options as op', 'op.id','=','quota.type')
            ->leftJoin('options as o', 'o.id','=','quota.time')
            ->leftJoin('options as oo', 'oo.id','=','quota.time_to')
            ->leftJoin('courses', 'courses.id','=','quota.course_id')
            ->leftJoin('teachers', 'teachers.id','=','courses.teacher_id')
            ->leftJoin('users as us', 'us.id','=','quota.created_by')
            ->leftJoin('users as u', 'u.id','=','quota.updated_by')
            ->select([ 'quota.id','quota.m_year','opti.title as day','opt.title as room','op.title as type','o.title as time','oo.title as time_to', 'courses.courseAR as course_id', 'teachers.name as teacher_id', 'quota.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('quota.isdelete','=','0');
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
        return 'Quota_' . date('YmdHis');
    }
}
