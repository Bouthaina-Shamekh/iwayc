<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class RepInventoryDataTable extends DataTable
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
            ->addColumn('action', 'repinventory.action')
            ->filter(function ($tasks) use ($request) {
                if ($request->has('repositoryId') and $request->get('repositoryId') != "") {
                    $tasks->where('rep_inventory.repository_id', '=', "{$request->get('repositoryId')}");
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
        return $model->newQuery()->leftJoin('rep_sections', 'rep_sections.id','=','rep_inventory.section_id')
            ->leftJoin('materials', 'materials.id','=','rep_inventory.material_id')
            ->select([ 'rep_inventory.id', 'rep_inventory.repository_id', 'rep_sections.name as section_id', 'materials.name as material_id', 'rep_inventory.pay_count', 'rep_inventory.last_price', 'rep_inventory.sum_pay', 'rep_inventory.count', 'rep_inventory.count_inv', 'rep_inventory.remaind', 'rep_inventory.rem_price'])
            ->where('rep_inventory.isdelete','=','0');
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
        return 'RepInventory_' . date('YmdHis');
    }
}
