<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class MaterialDataTable extends DataTable
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
            ->addColumn('action', 'material.action')
            ->editColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->addColumn('created_by', function ($tasks) {
                return $tasks->updated_by==null? $tasks->created_by:$tasks->updated_by;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('d-m-Y h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchMaterial') and $request->get('searchMaterial') != "") {
                    $tasks->where('materials.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('materials.name', 'like', "%{$request->get('searchMaterial')}%")
                                ->orWhere('rep_sections.name', 'like', "%{$request->get('searchMaterial')}%")
                                ->orWhere('us.name', 'like', "%{$request->get('searchMaterial')}%")
                                ->orWhere('u.name', 'like', "%{$request->get('searchMaterial')}%")
                                ->orWhere('repositories.name', 'like', "%{$request->get('searchMaterial')}%");
                        });
                }
                if ($request->has('repositoryId') and $request->get('repositoryId') != "") {
                    $tasks->where('repositories.id', '=', "{$request->get('repositoryId')}");
                }
                if ($request->has('sectionId') and $request->get('sectionId') != "") {
                    $tasks->where('rep_sections.id', '=', "{$request->get('sectionId')}");
                }
                if ($request->has('activeId') and $request->get('activeId') != "") {
                    $tasks->where('materials.active', '=', "{$request->get('activeId')}");
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
        return $model->newQuery()->leftJoin('rep_sections', 'rep_sections.id','=','materials.section')
            ->leftJoin('repositories', 'repositories.id','=','materials.repository_id')
            ->leftJoin('users as us', 'us.id','=','materials.created_by')
            ->leftJoin('users as u', 'u.id','=','materials.updated_by')
            ->select([ 'materials.id', 'materials.name', 'rep_sections.name as section', 'repositories.name as repository_id', 'materials.count_old', 'materials.count_new', 'materials.single_cost', 'materials.single_pay', 'materials.active', 'us.name as created_by', 'u.name as updated_by'])
            ->where('materials.isdelete','=','0');
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
        return 'Material_' . date('YmdHis');
    }
}
