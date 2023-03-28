<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class RepsoitoryOutDataTable extends DataTable
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
            ->addColumn('action', 'repsoitoryout.action')
            ->addColumn('userName', function ($tasks) {
                $tasks->updated_by != null?$tasks->updated_by:$tasks->created_by;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('d-m-Y h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchRepositoryOut') and $request->get('searchRepositoryOut') != "") {
                    $tasks->where('repository_outs.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('repository_outs.customer', 'like', "%{$request->get('searchRepositoryOut')}%")
                                ->orWhere('repository_outs.statement', 'like', "%{$request->get('searchRepositoryOut')}%")
                                ->orWhere('us.name', 'like', "%{$request->get('searchRepositoryOut')}%")
                                ->orWhere('u.name', 'like', "%{$request->get('searchRepositoryOut')}%")
                                ->orWhere('repositories.name', 'like', "%{$request->get('searchRepositoryOut')}%");
                        });
                }
                if ($request->has('repositoryId') and $request->get('repositoryId') != "") {
                    $tasks->where('repositories.id', '=', "{$request->get('repositoryId')}");
                }
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('us.id', '=', "{$request->get('userId')}")->orWhere('u.id', '=', "{$request->get('userId')}");
                }
                if ($request->has('fromId') and $request->has('toId') and $request->get('fromId') != "" and $request->get('toId') != "") {
                    $arrStart = explode("-", $request->get('fromId'));
                    $arrEnd = explode("-", $request->get('toId'));
                    $from = Carbon::create( $arrStart[0], $arrStart[1], $arrStart[2],0, 0, 0);
                    $to = Carbon::create( $arrEnd[0], $arrEnd[1], $arrEnd[2],23, 59, 59);
                    $tasks->whereBetween('repository_outs.created_at',[$from,$to]);
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('repository_outs.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->with('tot',$tasks->sum('repository_outs.total'));
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->leftJoin('repositories', 'repositories.id','=','repository_outs.repository_id')
            ->leftJoin('users as us', 'us.id','=','repository_outs.created_by')
            ->leftJoin('users as u', 'u.id','=','repository_outs.updated_by')
            ->select([ 'repository_outs.id','repository_outs.m_year', 'repositories.name as repository_id', 'repository_outs.customer', 'repository_outs.statement', 'repository_outs.total', 'repository_outs.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->whereRaw("(repository_outs.isdelete=0)");
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
        return 'RepsoitoryOut_' . date('YmdHis');
    }
}
