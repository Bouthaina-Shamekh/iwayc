<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class EmployeeDataTable extends DataTable
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
            ->addColumn('action', 'employee.action')
            ->addColumn('activeI', function ($tasks) {
                return $tasks->active;
            })
            ->editColumn('birthday', function ($tasks) {
                return $tasks->birthday ? with(new Carbon($tasks->birthday))->format('Y') : '';
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))->format('d-m-Y') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchEmployee') and $request->get('searchEmployee') != "") {
                    $tasks->where('employees.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('name', 'like', "%{$request->get('searchEmployee')}%")
                                ->orWhere('opt.title', 'like', "%{$request->get('searchEmployee')}%")
                                ->orWhere('op.title', 'like', "%{$request->get('searchEmployee')}%")
                                ->orWhere('birthday', 'like', "%{$request->get('searchEmployee')}%")
                                ->orWhere('phone1', 'like', "%{$request->get('searchEmployee')}%");

                        });
                }
                if ($request->has('jobId') and $request->get('jobId') != "") {
                    $tasks->where('opt.id', '=', "{$request->get('jobId')}");
                }
                if ($request->has('addressId') and $request->get('addressId') != "") {
                    $tasks->where('op.id', '=', "{$request->get('addressId')}");
                }
                if ($request->has('nationalityId') and $request->get('nationalityId') != "") {
                    $tasks->where('opte.id', '=', "{$request->get('nationalityId')}");
                }
                if ($request->has('statusId') and $request->get('statusId') != "") {
                    $tasks->where('optee.id', '=', "{$request->get('statusId')}");
                }

                if ($request->has('activeId') and $request->get('activeId') != "") {
                    $tasks->where('employees.active', '=', "{$request->get('activeId')}");
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
        return $model->newQuery()->leftJoin('options as opt', 'opt.id','=','employees.job_title')
            ->leftJoin('options as op', 'op.id','=','employees.address')
            ->leftJoin('options as opte', 'opte.id','=','employees.nationality')
            ->leftJoin('options as optee', 'optee.id','=','employees.status')
            //->leftJoin('options as opteee', 'opteee.id','=','employees.level')
            ->select(['employees.id', 'employees.name', 'opt.title as job', 'employees.birthday', 'nationality', 'employees.status', 'op.title as address','employees.phone1', 'employees.phone2', 'employees.email', 'employees.salary_down', 'employees.smoke', 'employees.notes', 'employees.active', 'employees.isdelete','employees.created_at'])
            ->where('employees.isdelete','=','0');


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
        return 'Employee_' . date('YmdHis');
    }
}
