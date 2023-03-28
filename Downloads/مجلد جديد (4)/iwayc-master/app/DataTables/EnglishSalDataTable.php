<?php

namespace App\DataTables;

use App\English;
use App\Level_eng;
use App\Level_up;
use App\Option;
use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class EnglishSalDataTable extends DataTable
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
            ->addColumn('action', 'englishsal.action')
            ->editColumn('created_by', function ($tasks) {
                return $tasks->updated_by?$tasks->updated_by:$tasks->created_by;
            })
            ->addColumn('level', function ($tasks) {
                $lev='';
                $isLevel_eng=Level_eng::where('eng_id',$tasks->id)->count();
                if ($isLevel_eng>0) {
                    $level_engs=Level_eng::where('eng_id',$tasks->id)->get();
                    foreach ($level_engs as $level_eng){
                        $lev = $lev.Option::find($level_eng->level_id)->title.' ';
                    }
                }else{
                    $lev='فحص المستوى';
                }
                return $lev;
            })
            ->addColumn('mark', function ($tasks) {
                $lev='';
                $isLevel_up=Level_up::where('student_id',$tasks->student_id)->count();
                if ($isLevel_up>0) {
                    $level_ups=Level_up::where('student_id',$tasks->student_id)->orderBy('id','desc')->first();
                    $lev=$level_ups->total;
                }else{
                    $english=English::where('id',$tasks->student_id)->first();
                    $lev=$english->total;
                }
                return $lev;
            })
            ->addColumn('date', function ($tasks) {
                $lev='';
                $isLevel_up=Level_up::where('student_id',$tasks->student_id)->count();
                if ($isLevel_up>0) {
                    $level_ups=Level_up::where('student_id',$tasks->student_id)->orderBy('id','desc')->first();
                    $lev=$level_ups->date;
                }else{
                    $english=English::where('id',$tasks->student_id)->first();
                    $lev=$english->date;
                }
                return $lev;
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchEnglishSal') and $request->get('searchEnglishSal') != "") {
                    $tasks->where('english_sal.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('opt.title', 'like', "%{$request->get('searchEnglishSal')}%")
                                ->orWhere('op.title', 'like', "%{$request->get('searchEnglishSal')}%")
                                ->orWhere('englishes.student_name', 'like', "%{$request->get('searchEnglishSal')}%");
                        });
                }
                if ($request->has('levelUpId') and $request->get('levelUpId') != "") {
                    $tasks->where('opti.id', '=', "{$request->get('levelUpId')}");
                }
                if ($request->has('typeId') and $request->get('typeId') != "") {
                    $tasks->where('o.id', '=', "{$request->get('typeId')}");
                }
                if ($request->has('resId') and $request->get('resId') != "") {
                    $tasks->where('english_sal.resolution', '=', "{$request->get('resId')}");
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
        return $model->newQuery()->leftJoin('englishes', 'englishes.id','=','english_sal.student_id')
            ->leftJoin('options as opti', 'opti.id','=','english_sal.level_up')
            ->leftJoin('options as opt', 'opt.id','=','english_sal.classification')
            ->leftJoin('options as op', 'op.id','=','english_sal.region')
            ->leftJoin('options as o', 'o.id','=','english_sal.type')
            ->leftJoin('users as us', 'us.id','=','english_sal.created_by')
            ->leftJoin('users as u', 'u.id','=','english_sal.updated_by')
            ->select(['english_sal.id','english_sal.student_id','englishes.student_name','english_sal.birthday','opti.title as up','opt.title as classification','op.title as region','english_sal.notes','english_sal.phone','o.title as type','english_sal.resolution','english_sal.created_at','us.name as created_by','u.name as updated_by'])
            ->where('english_sal.isdelete',0);
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
        return 'EnglishSal_' . date('YmdHis');
    }
}
