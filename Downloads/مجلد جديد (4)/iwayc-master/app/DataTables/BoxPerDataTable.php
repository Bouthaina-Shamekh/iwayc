<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class BoxPerDataTable extends DataTable
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
            ->addColumn('action', 'boxper.action')
            ->addColumn('repository_id', function ($tasks) {
                return $tasks->repository_id!=null?$tasks->repository_id:'بلا' ;
            })
            ->addColumn('per', function ($tasks) {
                $isPer=BoxPer::where('box_id',$tasks->id)->count();
                $ppppp=[];
                if ($isPer>0){
                    $per=BoxPer::where('box_id',$tasks->id)->get();
                    foreach ($per as $p){
                        $user=User::find($p->user_id)->name;
                        array_push($ppppp,$user);
                    }
                }
                return $ppppp;
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
        return $model->newQuery()->leftJoin('repositories as rep', 'rep.id','=','boxes.repository_id')
            ->select([ 'boxes.id','boxes.name','rep.name as repository_id','boxes.isdelete'])
            ->where('boxes.isdelete','=','0');
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
        return 'BoxPer_' . date('YmdHis');
    }
}
