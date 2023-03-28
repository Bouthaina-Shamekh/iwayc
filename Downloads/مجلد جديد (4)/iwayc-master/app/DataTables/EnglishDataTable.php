<?php

namespace App\DataTables;

use App\Models\English;
use Carbon\Carbon;
use Yajra\DataTables\Services\DataTable;

class EnglishDataTable extends DataTable
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
            ->addColumn('action', 'english.action')
            ->editColumn('created_by', function ($tasks) {
                return $tasks->updated_by?$tasks->updated_by:$tasks->created_by;
            })
            ->editColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->editColumn('date', function ($tasks) {
                return $tasks->date ? with(new Carbon($tasks->date))->format('d-m-Y') : '';
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('d-m-Y h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchEnglish') and $request->get('searchEnglish') != "") {
                    $tasks->where('englishes.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('student_name', 'like', "%{$request->get('searchEnglish')}%")
                                ->orWhere('op.title', 'like', "%{$request->get('searchEnglish')}%")
                                ->orWhere('englishes.cash_rec_id', 'like', "%{$request->get('searchEnglish')}%")
                                ->orWhere('englishes.date', 'like', "%{$request->get('searchEnglish')}%")
                                ->orWhere('opt.title', 'like', "%{$request->get('searchEnglish')}%");
                        });
                }
                if ($request->has('classId') and $request->get('classId') != "") {
                    $tasks->where('opt.id', '=', "{$request->get('classId')}");
                }
                if ($request->has('levelId') and $request->get('levelId') != "") {
                    $tasks->where('op.id', '=', "{$request->get('levelId')}");
                }
                if ($request->has('activeId') and $request->get('activeId') != "") {
                    $tasks->where('englishes.active', '=', "{$request->get('activeId')}");
                }
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(English $model)
    {
        return $model->newQuery()->leftJoin('options as opt', 'opt.id','=','englishes.classification')
            ->leftJoin('options as op', 'op.id','=','englishes.level_pass')
            ->leftJoin('users as us', 'us.id','=','englishes.created_by')
            ->leftJoin('users as u', 'u.id','=','englishes.updated_by')
            ->select([ 'englishes.id', 'englishes.date', 'student_name', 'englishes.cash_rec_id', 'englishes.total', 'op.title as level_pass', 'opt.title as classification', 'englishes.active', 'englishes.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('englishes.

            ','=','0');
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
        return 'English_' . date('YmdHis');
    }
}
