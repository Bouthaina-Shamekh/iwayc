<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class EnglishRegDataTable extends DataTable
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
            ->addColumn('action', 'englishreg.action')
            ->addColumn('phone',function ($tasks){
                $phone='';
                if ($tasks->phone1 != null){
                    $phone = $phone.$tasks->phone1;
                }
                if ($tasks->phone2 != null){
                    $phone =$phone.'-'.$tasks->phone2;
                }
                return $phone;
            })
            ->editColumn('status', function ($tasks) {
                if ($tasks->status==0){
                    return 'فعال';
                }elseif ($tasks->status==1){
                    return 'منسحب';
                }else{
                    return 'ناجح';
                }
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchEnglishReg') and $request->get('searchEnglishReg') != "") {
                    $tasks->where('english_reg.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('options.title', 'like', "%{$request->get('searchEnglishReg')}%")
                                ->orWhere('englishes.student_name', 'like', "%{$request->get('searchEnglishReg')}%");
                        });
                }
                if ($request->has('studentId') and $request->get('studentId') != "") {
                    $tasks->where('englishes.id', '=', "{$request->get('studentId')}");
                }
                if ($request->has('levelId') and $request->get('levelId') != "") {
                    $tasks->where('options.id', '=', "{$request->get('levelId')}");
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
        return $model->newQuery()->leftJoin('englishes', 'englishes.id','=','english_reg.student_id')
            ->leftJoin('options', 'options.id','=','english_reg.level_id')
            ->leftJoin('users', 'users.id','=','english_reg.created_by')
            ->select(['english_reg.id','english_reg.ispass','english_reg.isdelete','english_reg.iswithdrawal','english_reg.status','english_reg.created_at','users.name as created_by','options.title as level_id','englishes.student_name','englishes.phone1','englishes.phone2','englishes.year'])
            ->where('english_reg.isdelete',0);
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
        return 'EnglishReg_' . date('YmdHis');
    }
}
