<?php

namespace App\DataTables;

use App\Models\Campaign_student;
use Yajra\DataTables\Services\DataTable;

class CampaignStudentDataTable extends DataTable
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
            ->addColumn('action', 'campaignstudent.action')
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))
                    ->format('d-m-Y') : '';
            })
            ->editColumn('created_by', function ($tasks) {
                return $tasks->updated_by ? $tasks->updated_by : $tasks->created_by;
            })
            ->editColumn('resolution', function ($tasks) {
                return $tasks->resolution==1 ? 'متابعة' : 'لم ينظر';
            })
            ->editColumn('notes', function ($tasks) {
                return str_limit($tasks->notes,50);
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchCampaign') and $request->get('searchCampaign') != "") {
                    $tasks->where('courses.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('students.nameAR', 'like', "%{$request->get('searchCampaign')}%")
                                ->orWhere('campaign_student.birthday', 'like', "%{$request->get('searchCampaign')}%")
                                ->orWhere('o.title', 'like', "%{$request->get('searchCampaign')}%")
                                ->orWhere('op.title', 'like', "%{$request->get('searchCampaign')}%")
                                ->orWhere('opt.title', 'like', "%{$request->get('searchCampaign')}%")
                                ->orWhere('courses.courseAR', 'like', "%{$request->get('searchCampaign')}%")
                                ->orWhere('campaign_student.notes', 'like', "%{$request->get('searchCampaign')}%")
                                ->orWhere('campaign_student.phone', 'like', "%{$request->get('searchCampaign')}%");
                        });
                }/*
                if ($request->has('teacherId') and $request->get('teacherId') != "") {
                    $tasks->where('teachers.id', '=', "{$request->get('teacherId')}");
                }
                if ($request->has('activeId') and $request->get('activeId') != "") {
                    $tasks->where('courses.active', '=', "{$request->get('activeId')}");
                }*/
                if ($request->has('uId') and $request->get('uId') != "") {
                    $tasks->where('campaign_student.campaign_id', '=', "{$request->get('uId')}");
                };
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Campaign_student $model)
    {
        return $model->newQuery()->leftJoin('users as us', 'us.id','=','campaign_student.created_by')
            ->leftJoin('users as u', 'u.id','=','campaign_student.updated_by')
            ->leftJoin('students', 'students.id','=','campaign_student.name')
            ->leftJoin('options as o', 'o.id','=','campaign_student.address')
            ->leftJoin('options as op', 'op.id','=','campaign_student.type')
            ->leftJoin('options as opt', 'opt.id','=','campaign_student.response')
            ->leftJoin('courses', 'courses.id','=','campaign_student.course_reg')
            ->select([ 'campaign_student.id', 'campaign_student.campaign_id',  'students.nameAR as name',  'campaign_student.birthday',  'o.title as address',  'courses.courseAR as course_reg',  'op.title as type',  'campaign_student.notes',  'campaign_student.phone',  'opt.title as response',  'campaign_student.resolution', 'campaign_student.created_at', 'us.name as created_by', 'u.name as updated_by', 'campaign_student.isdelete'])
            ->where('campaign_student.isdelete','=','0');
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
        return 'CampaignStudent_' . date('YmdHis');
    }
}
