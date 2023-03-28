<?php

namespace App\DataTables;

use App\Models\Absence;
use Carbon\Carbon;
use Yajra\DataTables\Services\DataTable;

class AbsenceDataTable extends DataTable
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
            //->addColumn('link', "<a href='/edit/'>mm</a>")
            ->addColumn('action', 'cms.absence.action')
            ->editColumn('center_car', function ($tasks) {
                if($tasks->atype ==125 ||$tasks->atype ==126||$tasks->atype ==127){
                    if($tasks->center_car == "1"){
                        return 'نعم';
                    }else{
                        return 'لا';
                    }


                }else{
                    return " ";
                }
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('Y-m-d') : '';
            })
            ->addColumn('hour_in', function ($tasks) {
                if($tasks->atype ==124 ||$tasks->atype ==336){
                    $bIn ="";
                }else{
                    $bIn = '<button name="btnIn'.$tasks->id.'" class="btn btn-sm btn-primary" id="'.$tasks->id.'" onclick="fIn(this)" disabled><i class="far fa-arrow-alt-circle-right fa-lg"></i></button>';
                    if($tasks->hour_in==null && $tasks->hour_out!=null){
                        $bIn = '<button name="btnIn'.$tasks->id.'" class="btn btn-sm btn-primary" id="'.$tasks->id.'" onclick="fIn(this)"><i class="far fa-arrow-alt-circle-right fa-lg"></i></button>';
                    }
                    if($tasks->hour_in!=null){
                        $bIn =  date("Y-m-d h:i", strtotime($tasks->hour_in));
                    }
                }
                return $bIn;
            })
            ->addColumn('hour_out', function ($tasks) {
                if($tasks->atype ==124||$tasks->atype ==336){
                    $bOut ="";
                }else{

                $bOut = date("Y-m-d h:i", strtotime($tasks->hour_out));
                if($tasks->hour_out==null){
                    $bOut = '<button class="btn btn-sm btn-primary" id="'.$tasks->id.'" onclick="fOut(this)"><i class="far fa-arrow-alt-circle-left fa-lg"></i></button>';
                }
                }
                return $bOut;
            })
            ->addColumn('difference', function ($tasks) {


             if($tasks->hour_out!=null &&$tasks->hour_in!=null){

            $start = Carbon::parse($tasks->hour_out);
            $end = Carbon::parse($tasks->hour_in);
            $hours = $end->diffInHours($start);
            $seconds = $end->diffInMinutes($start);

            return $hours . ':' . $seconds;
             }


            })
            ->addColumn('ac', function ($tasks) {
                $show = '<a class="btn btn-sm btn-warning" href="/CMS/Absence/'.$tasks->id.'">عرض</a>';
                $edit = '<a class="btn btn-sm btn-info" href="/CMS/Absence/'.$tasks->id.'/edit">تعديل</a>';
                $delete = '<a class="btn Confirm btn-sm btn-danger" href="/CMS/delete/Absence/'.$tasks->id.'">حذف</a>';
                return $show.' '.$edit.' '.$delete;
            })
            ->rawColumns(['hour_in','hour_out','ac'])
            ->filter(function ($tasks) {
                if ($this->request()->has('search_h') and $this->request()->get('search_h') != "") {
                    $tasks->where('absences.isdelete','=','0')
                        ->where(function ($tasks){
                            $keyword = $this->request()->get('search_h');
                            $tasks->where('opt.title', 'like', "%{$keyword}%")
                                ->orWhere('op.title', 'like', "%{$keyword}%")
                                ->orWhere('o.title', 'like', "%{$keyword}%")
                                ->orWhere('employees.name', 'like', "%{$keyword}%");
                        });
                }
                if ($this->request()->has('employee_h') and $this->request()->get('employee_h') != "") {
                    $tasks->where('employees.id', '=', "{$this->request()->get('employee_h')}");
                }
                if ($this->request()->has('region_h') and $this->request()->get('region_h') != "") {
                    $tasks->where('opt.id', '=', "{$this->request()->get('region_h')}");
                }
                if ($this->request()->has('type_h') and $this->request()->get('type_h') != "") {
                    $tasks->where('op.id', '=', "{$this->request()->get('type_h')}");
                }
                if ($this->request()->has('leaving_h') and $this->request()->get('leaving_h') != "") {
                    $tasks->where('o.id', '=', "{$this->request()->get('leaving_h')}");
                }
                if ($this->request()->has('money_h') and $this->request()->get('money_h') != "") {
                    $tasks->where('absences.m_year', '=', "{$this->request()->get('money_h')}");
                }


                if ($this->request()->has('from_h') and $this->request()->has('to_h') and $this->request()->get('from_h') != "" and $this->request()->get('to_h') != "") {
                    $from=$this->request()->get('from_h');
                    $to=$this->request()->get('to_h');
                    $tasks->whereBetween('absences.created_at',[$from,$to]);


                }
            })
            ->with(['count_rows'=> function($tasks){
           return $tasks->count('absences.id');
        },'sum_diff'=> function($tasks){
            $time=$tasks->sum('absences.hours')*60 +$tasks->sum('absences.minutes') ;
            $hours = floor($time / 60);
            $minutes = ($time % 60);
            //$seconds=$tasks->where('absences.type',"!=","124")->sum(\DB::raw("TIME_TO_SEC(TIMEDIFF(hour_in,hour_out))"));

           return $hours.":".$minutes;
        }]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Absence $model)
    {
        return $model->newQuery()->leftJoin('employees', 'employees.id','=','absences.employee_id')
            ->leftJoin('options as opt', 'opt.id','=','absences.region')
            ->leftJoin('options as op', 'op.id','=','absences.type')
            ->leftJoin('options as o', 'o.id','=','absences.leaving')
            ->select([ 'absences.id','absences.type as atype', 'absences.m_year', 'employees.name as employee_id', 'absences.hour_out', 'absences.hour_in','absences.hours','absences.minutes', 'op.title as type', 'absences.center_car', 'opt.title as region', 'o.title as leaving', 'absences.created_at'])
            ->where('absences.isdelete','=','0');
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
                    /*->addAction([
                        'data' => 'id',
                        'name' => 'id',
                        'render' => 'cms.absence.action'
                        'render' => function (){
                            return 'function (data,type,row){return "<a href=\"/edit/"+data+"\"></a>"}';
                        }
                    ])*/
                    ->parameters(array_merge($this->getBuilderParameters(),[
                        'buttons' => [
                            ['extend'=>'excel','text'=>' أكسيل'],
                            ['extend'=>'print','text'=>' طباعة '],
                            ['extend'=>'pdf','text'=>' ملف pdf '],
                            ['extend'=>'pageLength','text'=>' حجم العرض ']
                        ],
                        'language' => [
                            'url' => 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
                        ]
                    ]));
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['data'=>'id','title'=>'##'],
            ['data'=>'employee_id','title'=>'اسم الموظف'],
            ['data'=>'hour_out','title'=>'خروج'],
            ['data'=>'hour_in','title'=>'عودة'],
            ['data'=>'difference','title'=>'المدة'],
            ['data'=>'type','title'=>'تصنيف المغادرة'],
            ['data'=>'center_car','title'=>'باستخدام سيارة المركز'],
            ['data'=>'region','title'=>'المنطقة'],
            ['data'=>'leaving','title'=>'غاية المغادرة'],
            ['data'=>'created_at','title'=>'تاريخ الطلب','width'=>'15%'],
            ['data'=>'ac','title'=>'العمليات','width'=>'15%']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
 /*    protected function filename()
    {
        return 'Absence_' . date('YmdHis');
    } */
}
