<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class CertificateDataTable extends DataTable
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
            ->addColumn('action', 'certificate.action')
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('d-m-Y') : '';
            })
            ->editColumn('release_date', function ($tasks) {
                return $tasks->release_date ? with(new Carbon($tasks->release_date))->format('d-m-Y') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchCertificate') and $request->get('searchCertificate') != "") {
                    $tasks->where('certificates.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('opt.title', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('students.nameAR', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('students.nameEN', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('o.title', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('op.title', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.place_birth', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.year_birth', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.start_day', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.end_day', 'like', "%{$request->get('searchCertificate')}%")
                                ->orWhere('certificates.catch_receipt_id', 'like', "%{$request->get('searchCertificate')}%");
                        });
                }
                if ($request->has('typeId') and $request->get('typeId') != "") {
                    $tasks->where('opt.id', '=', "{$request->get('typeId')}");
                }
                if ($request->has('studentId') and $request->get('studentId') != "") {
                    $tasks->where('students.id', '=', "{$request->get('studentId')}");
                }
                if ($request->has('courseId') and $request->get('courseId') != "") {
                    $tasks->where('o.id', '=', "{$request->get('courseId')}");
                }
                if ($request->has('statusId') and $request->get('statusId') != "") {
                    $tasks->where('certificates.print_execute', '=', "{$request->get('statusId')}");
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
        return $model->newQuery()->leftJoin('options as opt', 'opt.id','=','certificates.type')
            ->leftJoin('options as op', 'op.id','=','certificates.appreciation')
            ->leftJoin('options as o', 'o.id','=','certificates.course_id')
            ->leftJoin('students', 'students.id','=','certificates.student_id')
            ->select([ 'certificates.id', 'opt.title as type', 'students.nameAR as studentAR', 'students.nameEN as studentEN', 'o.title as courseAR', 'certificates.place_birth', 'certificates.year_birth', 'certificates.start_day', 'certificates.end_day', 'op.title as appreciation', 'certificates.certificate_fees', 'certificates.catch_receipt_id', 'certificates.print_execute', 'certificates.release_date'])
            ->where('certificates.isdelete','=','0');
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
        return 'Certificate_' . date('YmdHis');
    }
}
