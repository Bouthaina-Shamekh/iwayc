<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class QuantityDataTable extends DataTable
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
            ->addColumn('action', 'quantity.action')
            ->addColumn('created_by', function ($tasks) {
                return $tasks->updated_by==null? $tasks->created_by:$tasks->updated_by;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('d-m-Y h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchQuantity') and $request->get('searchQuantity') != "") {
                    $tasks->where('quantities.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('materials.name', 'like', "%{$request->get('searchQuantity')}%")
                                ->orWhere('rep_sections.name', 'like', "%{$request->get('searchQuantity')}%")
                                ->orWhere('repositories.name', 'like', "%{$request->get('searchQuantity')}%");
                        });
                }
                if ($request->has('repositoryId') and $request->get('repositoryId') != "") {
                    $tasks->where('repositories.id', '=', "{$request->get('repositoryId')}");
                }
                if ($request->has('sectionId') and $request->get('sectionId') != "") {
                    $tasks->where('rep_sections.id', '=', "{$request->get('sectionId')}");
                }
                if ($request->has('materialId') and $request->get('materialId') != "") {
                    $tasks->where('materials.id', '=', "{$request->get('materialId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('quantities.m_year', '=', "{$request->get('moneyId')}");
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
        return $model->newQuery()->leftJoin('rep_sections', 'rep_sections.id','=','quantities.section')
            ->leftJoin('repositories', 'repositories.id','=','quantities.repository_id')
            ->leftJoin('materials', 'materials.id','=','quantities.material_id')
            ->leftJoin('users as us', 'us.id','=','quantities.created_by')
            ->leftJoin('users as u', 'u.id','=','quantities.updated_by')
            ->select([ 'quantities.id','quantities.m_year', 'materials.name as material_id', 'rep_sections.name as section', 'repositories.name as repository_id', 'quantities.count', 'quantities.count_old', 'quantities.count_new', 'quantities.single_cost', 'quantities.single_pay', 'quantities.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('quantities.isdelete','=','0');
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
        return 'Quantity_' . date('YmdHis');
    }
}
