<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class LevelUpDataTable extends DataTable
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
            ->addColumn('action', 'levelup.action')
            ->editColumn('created_by', function ($tasks) {
                return $tasks->updated_by?$tasks->updated_by:$tasks->created_by;
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchLevelUp') and $request->get('searchLevelUp') != "") {
                    $tasks->where('level_ups.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('opt.title', 'like', "%{$request->get('searchLevelUp')}%")
                                ->orWhere('op.title', 'like', "%{$request->get('searchLevelUp')}%")
                                ->orWhere('englishes.student_name', 'like', "%{$request->get('searchLevelUp')}%");
                        });
                }
                if ($request->has('studentId') and $request->get('studentId') != "") {
                    $tasks->where('englishes.id', '=', "{$request->get('studentId')}");
                }
                if ($request->has('levelId') and $request->get('levelId') != "") {
                    $tasks->where('opt.id', '=', "{$request->get('levelId')}");
                }
                if ($request->has('levelUpId') and $request->get('levelUpId') != "") {
                    $tasks->where('op.id', '=', "{$request->get('levelUpId')}");
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
        return $model->newQuery()->leftJoin('englishes', 'englishes.id','=','level_ups.student_id')
            ->leftJoin('options as opt', 'opt.id','=','level_ups.level')
            ->leftJoin('options as op', 'op.id','=','level_ups.level_up')
            ->leftJoin('users as us', 'us.id','=','level_ups.created_by')
            ->leftJoin('users as u', 'u.id','=','level_ups.updated_by')
            ->select(['level_ups.id','level_ups.date','level_ups.total','opt.title as level','op.title as level_up','englishes.student_name','level_ups.created_at','us.name as created_by','u.name as updated_by'])
            ->where('level_ups.isdelete',0);
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
        return 'LevelUp_' . date('YmdHis');
    }
}
