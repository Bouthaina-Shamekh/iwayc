<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class CollectionFeesDataTable extends DataTable
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
            ->addColumn('action', 'collectionfees.action')
            ->editColumn('evasion', function ($tasks) {
                return $tasks->evasion==0?'لا':'نعم';
            })
            ->addColumn('hour12', function ($tasks) {
                $vv=0;
                if($tasks->count==0){
                    $vv=1;
                }else{
                    $count_claim = Count_claim::where('collection_fees_id',$tasks->id)->orderBy('id','desc')->first();
                    $start = Carbon::now();
                    $end =  Carbon::parse($count_claim->created_at);
                    $hours = $end->diffInHours($start);
                    if ($hours>=12){
                        $vv=1;
                    }
                }
                return $vv;
            })
    
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchCollectionFees') and $request->get('searchCollectionFees') != "") {
                    $tasks->where('collection_fees.isdelete','=','0')
                        ->where(function ($tasks) use ($request) {
                            $tasks->where('courses.courseAR', 'like', "%{$request->get('searchCollectionFees')}%")
                                ->orWhere('students.nameAR', 'like', "%{$request->get('searchCollectionFees')}%")
                                ->orWhere('collection_fees.phone', 'like', "%{$request->get('searchCollectionFees')}%")
                                ->orWhere('collection_fees.fees', 'like', "%{$request->get('searchCollectionFees')}%")
                                ->orWhere('collection_fees.fees_pay', 'like', "%{$request->get('searchCollectionFees')}%")
                                ->orWhere('collection_fees.fees_owed', 'like', "%{$request->get('searchCollectionFees')}%")
                                ->orWhere('collection_fees.warranty', 'like', "%{$request->get('searchCollectionFees')}%")
                                ->orWhere('collection_fees.count', 'like', "%{$request->get('searchCollectionFees')}%");
                        });
                }
                if ($request->has('studentId') and $request->get('studentId') != "") {
                    $tasks->where('students.id', '=', "{$request->get('studentId')}");
                }
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $tasks->where('courses.id', '=', "{$request->get('courseId')}");
                }
                if ($request->has('warrantyId') and $request->get('warrantyId') != "") {
                    $tasks->where('collection_fees.warranty', '=', "{$request->get('warrantyId')}");
                }
                if ($request->has('statusId') and $request->get('statusId') != "") {
                    $tasks->where('collection_fees.evasion', '=', "{$request->get('statusId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('collection_fees.m_year', '=', "{$request->get('moneyId')}");
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
        return $model->newQuery()->leftJoin('student_course as sc', 'sc.id','=','collection_fees.student_course_id')
            ->leftJoin('courses', 'courses.id','=','sc.course_id')
            ->leftJoin('students', 'students.id','=','sc.student_id')
            ->select(['collection_fees.id', 'collection_fees.m_year','courses.courseAR','students.nameAR','collection_fees.phone','collection_fees.fees','collection_fees.fees_pay','collection_fees.fees_owed','collection_fees.warranty','collection_fees.count','collection_fees.evasion','collection_fees.notes','collection_fees.isdelete','collection_fees.created_by','collection_fees.updated_by','collection_fees.created_at'])
            ->where('collection_fees.isdelete','=','0');
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
        return 'CollectionFees_' . date('YmdHis');
    }
}
