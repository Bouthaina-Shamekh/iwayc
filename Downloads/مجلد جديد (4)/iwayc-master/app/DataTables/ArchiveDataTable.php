<?php

namespace App\DataTables;

use App\Models\Archive;
use Yajra\DataTables\Services\DataTable;

class ArchiveDataTable extends DataTable
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
            ->addColumn('action', 'archive.action')
            ->addColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('d-m-Y') : '';
            })
            ->filter(function ($tasks) {
                if ($this->request()->has('searchArchive') and $this->request()->get('searchArchive') != "") {
                    $tasks->where('archives.isdelete','=','0')
                        ->where(function ($tasks) {
                            $keyword = $this->request()->get('search_h');
                            $tasks->where('opt.title', 'like', "%{$keyword}%")
                                ->orWhere('op.title', 'like', "%{$keyword}%")
                                ->orWhere('address', 'like', "%{$keyword}%");
                        });
                }
                if ($this->request()->has('sectionId') and $this->request()->get('sectionId') != "") {
                    $tasks->where('opt.id', '=', "{$this->request()->get('sectionId')}");
                }
                if ($this->request()->has('subSectionId') and $this->request()->get('subSectionId') != "") {
                    $tasks->where('op.id', '=', "{$this->request()->get('subSectionId')}");
                }
                if ($this->request()->has('activeId') and $this->request()->get('activeId') != "") {
                    $tasks->where('archives.active', '=', "{$this->request()->get('activeId')}");
                }
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Archive $model)
    {
        return $model->newQuery()->leftJoin('options as opt', 'opt.id','=','archives.section')
            ->leftJoin('options as op', 'op.id','=','archives.sub_section')
            ->select([ 'archives.id', 'opt.title as section', 'op.title as sub_section', 'archives.address', 'archives.active', 'archives.created_at'])
            ->where('archives.isdelete','=','0');
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
            'address',
            'section',
            'sub_section',
            'activeI',
            'created_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Archive_' . date('YmdHis');
    }
}
