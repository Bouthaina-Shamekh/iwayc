<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class RepsoitoryInDataTable extends DataTable
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
            ->addColumn('action', 'repsoitoryin.action')
            ->addColumn('userName', function ($tasks) {
                return $tasks->updated_by!=null?$tasks->updated_by:$tasks->created_by;
            })
            ->addColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('d-m-Y h:i') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchRepositoryIn') and $request->get('searchRepositoryIn') != "") {
                    $tasks->where('repository_ins.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('materials.name', 'like', "%{$request->get('searchRepositoryIn')}%")
                                ->orWhere('rep_sections.name', 'like', "%{$request->get('searchRepositoryIn')}%")
                                ->orWhere('us.name', 'like', "%{$request->get('searchRepositoryIn')}%")
                                ->orWhere('u.name', 'like', "%{$request->get('searchRepositoryIn')}%")
                                ->orWhere('repositories.name', 'like', "%{$request->get('searchRepositoryIn')}%");
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
                if ($request->has('userId') and $request->get('userId') != "") {
                    $tasks->where('us.id', '=', "{$request->get('userId')}");
                }
                if ($request->has('fromId') and $request->has('toId') and $request->get('fromId') != "" and $request->get('toId') != "") {
                    $arrStart = explode("-", $request->get('fromId'));
                    $arrEnd = explode("-", $request->get('toId'));
                    $from = Carbon::create( $arrStart[0], $arrStart[1], $arrStart[2],0, 0, 0);
                    $to = Carbon::create( $arrEnd[0], $arrEnd[1], $arrEnd[2],23, 59, 59);
                    $tasks->whereBetween('repository_ins.created_at',[$from,$to]);
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('repository_ins.m_year', '=', "{$request->get('moneyId')}");
                }
            })
            ->with('tot',$tasks->sum('repository_ins.total'))
            ->with('qua',$tasks->sum('repository_ins.quantity'));
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->leftJoin('repositories', 'repositories.id','=','repository_ins.repository_id')
            ->leftJoin('rep_sections', 'rep_sections.id','=','repository_ins.section')
            ->leftJoin('users as us', 'us.id','=','repository_ins.created_by')
            ->leftJoin('users as u', 'u.id','=','repository_ins.updated_by')
            ->leftJoin('materials', 'materials.id','=','repository_ins.material_id')
            ->select([ 'repository_ins.id','repository_ins.m_year', 'materials.name as material_id', 'rep_sections.name as section', 'repositories.name as repository_id', 'repository_ins.quantity', 'repository_ins.total', 'repository_ins.created_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('repository_ins.isdelete','=','0');
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
        return 'RepsoitoryIn_' . date('YmdHis');
    }
}
