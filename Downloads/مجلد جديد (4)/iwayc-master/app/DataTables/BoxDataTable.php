<?php

namespace App\DataTables;

use App\Models\Box_year;
use App\Models\BoxPer;
use App\Models\Box;
use Yajra\DataTables\Services\DataTable;

class BoxDataTable extends DataTable
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
            ->addColumn('action', 'box.action')
            ->editColumn('income', function ($tasks) {
                return number_format($tasks->income,2);
            })
            ->editColumn('expense', function ($tasks) {
                return number_format($tasks->expense,2);
            })
            ->editColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->editColumn('parent_id', function ($tasks) {
                return $tasks->parent_id!=null ? $tasks->parent_id:'بلا';
            })
            ->addColumn('total', function ($tasks) {
                return number_format($tasks->income-$tasks->expense,2) ;
            })
            ->addColumn('repository_id', function ($tasks) {
                return $tasks->repository_id!=null?$tasks->repository_id:'بلا' ;
            })
            ->addColumn('per', function ($tasks) {
                $isPer=BoxPer::where('box_id',$tasks->id)->count();
                $ppppp=[];
                if ($isPer>0){
                    $per=BoxPer::where('box_id',$tasks->id)->get();
                    foreach ($per as $p){
                        $user=User::find($p->user_id)->id;
                        array_push($ppppp,$user);
                    }
                }
                return $ppppp;
            })
            ->addColumn('lock', function ($tasks) {
                $isPer=Box_year::where('box_id',$tasks->id)->where('m_year',$this->getMoneyYear())->count();
                $lock=0;
                if ($isPer>0){
                    $per=Box_year::where('box_id',$tasks->id)->where('m_year',$this->getMoneyYear())->first();
                    $lock=$per->islock;
                }
                return $lock;
            })
            ->filter(function ($tasks) {
                if ($this->request()->has('searchBox') && $this->request()->get('searchBox') != "") {
                    $tasks->where('boxes.isdelete','=','0')
                        ->where(function ($tasks) {
                            $keyword = $this->request()->get('search_h');
                            $tasks->where('options.title', 'like', "%{$keyword}%")
                                ->orWhere('boxes.name', 'like', "%{$keyword}%")
                                ->orWhere('b.name', 'like', "%{$keyword}%");
                        });
                }
                if ($this->request()->has('moneyId') and $this->request()->get('moneyId') != "") {
                    $keyword = $this->request()->get('active_h');
                    $tasks->leftJoin('box_year', 'box_year.box_id','=','boxes.id')
                        ->select([ 'boxes.id', 'boxes.m_year', 'boxes.name', 'rep.name as repository_id', 'options.title as type', 'box_year.calculator_first','b.name as parent_id','box_year.income','box_year.expense','boxes.active', 'boxes.created_at', 'boxes.isdelete'])
                        ->where('box_year.m_year','=',"{$this->request()->get('moneyId')}");
                }
                if ($this->getId()!=null) {
                    $tasks->leftJoin('box_per', 'box_per.box_id','=','boxes.id')
                        ->select([ 'boxes.id', 'boxes.m_year', 'boxes.name', 'rep.name as repository_id', 'options.title as type', 'box_year.calculator_first','b.name as parent_id','box_year.income','box_year.expense','boxes.active', 'boxes.created_at', 'boxes.isdelete'])
                        ->where('box_per.user_id','=',"{$this->getId()}");
                }
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Box $model)
    {
        return $model->newQuery()->leftJoin('options', 'options.id','=','boxes.type')
            ->leftJoin('boxes as b', 'b.id','=','boxes.parent_id')
            ->leftJoin('repositories as rep', 'rep.id','=','boxes.repository_id')
            ->select([ 'boxes.id', 'boxes.m_year', 'boxes.name', 'rep.name as repository_id', 'options.title as type', 'boxes.calculator_first','b.name as parent_id','boxes.income','boxes.expense','boxes.active', 'boxes.created_at', 'boxes.isdelete'])
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
            'lock',
            'name',
            'type',
            'repository_id',
            'calculator_first',
            'parent_id',
            'income',
            'expense',
            'total',
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
        return 'Box_' . date('YmdHis');
    }
}
