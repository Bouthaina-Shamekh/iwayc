<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class LegalAffairsDataTable extends DataTable
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
            ->addColumn('action', 'legalaffairs.action')
            ->addColumn('hour12', function ($tasks) {
                $vv=0;
                if($tasks->count_warning==0){
                    $vv=1;
                }else{
                    $isCount_warning = Count_warning::where('legal_affairs_id',$tasks->id)->orderBy('id','desc')->count();
                    if ($isCount_warning>0){
                        $count_warning = Count_warning::where('legal_affairs_id',$tasks->id)->orderBy('id','desc')->first();
                        $start = Carbon::now();
                        $end =  Carbon::parse($count_warning->created_at);
                        $hours = $end->diffInHours($start);
                        if ($hours>=12){
                            $vv=1;
                        }
                    }
                }/**/
                return $vv;
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchLegalAffairs') and $request->get('searchLegalAffairs') != "") {
                    $tasks->where('legal_affairs.isdelete','=','0')
                        ->where(function ($tasks) use ($request) {
                            $tasks->where('students.nameAR', 'like', "%{$request->get('searchLegalAffairs')}%")
                                ->orWhere('legal_affairs.phone', 'like', "%{$request->get('searchLegalAffairs')}%")
                                ->orWhere('legal_affairs.fees', 'like', "%{$request->get('searchLegalAffairs')}%")
                                ->orWhere('legal_affairs.fees_owed', 'like', "%{$request->get('searchLegalAffairs')}%")
                                ->orWhere('legal_affairs.first_claim', 'like', "%{$request->get('searchLegalAffairs')}%")
                                ->orWhere('legal_affairs.fine_delay', 'like', "%{$request->get('searchLegalAffairs')}%")
                                ->orWhere('legal_affairs.total_amount', 'like', "%{$request->get('searchLegalAffairs')}%")
                                ->orWhere('legal_affairs.count', 'like', "%{$request->get('searchLegalAffairs')}%")
                                ->orWhere('legal_affairs.count_warning', 'like', "%{$request->get('searchLegalAffairs')}%")
                                ->orWhere('legal_affairs.status', 'like', "%{$request->get('searchLegalAffairs')}%");
                        });
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('legal_affairs.m_year', '=', "{$request->get('moneyId')}");
                }/*
            if ($request->has('senderId') and $request->get('senderId') != "") {
                $tasks->where('us.id', '=', "{$request->get('senderId')}");
            }
            if ($request->has('receiverId') and $request->get('receiverId') != "") {
                $tasks->where('u.id', '=', "{$request->get('receiverId')}");
            }
            if ($request->has('categoryId') and $request->get('categoryId') != "") {
                $tasks->where('options.id', '=', "{$request->get('categoryId')}");
            }
            if ($request->has('activeId') and $request->get('activeId') != "") {
                $tasks->where('tasks.active', '=', "{$request->get('activeId')}");
            }*/
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
        return $model->newQuery()->leftJoin('student_course as sc', 'sc.id','=','legal_affairs.student_course_id')
            ->leftJoin('courses', 'courses.id','=','sc.course_id')
            ->leftJoin('students', 'students.id','=','sc.student_id')
            ->leftJoin('users', 'users.id','=','legal_affairs.created_by')
            ->leftJoin('options', 'options.id','=','legal_affairs.status')
            ->select(['legal_affairs.id', 'legal_affairs.m_year','courses.courseAR','students.nameAR','legal_affairs.phone','legal_affairs.fees','legal_affairs.fees_owed','legal_affairs.first_claim','legal_affairs.count_day','legal_affairs.fine_day','legal_affairs.fine_delay','legal_affairs.total_amount','legal_affairs.warranty','legal_affairs.count','legal_affairs.count_warning','options.title as status','legal_affairs.notes','legal_affairs.isdelete','users.name as created_by','legal_affairs.updated_by','legal_affairs.created_at'])
            ->where('legal_affairs.isdelete','=','0');
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
        return 'LegalAffairs_' . date('YmdHis');
    }
}
