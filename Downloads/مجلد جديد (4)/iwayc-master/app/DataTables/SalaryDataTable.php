<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class SalaryDataTable extends DataTable
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
            ->addColumn('action', 'salary.action')
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))
                    ->format('d-m-Y') : '';
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchSalary') && $request->get('searchSalary') != "") {
                    $tasks->where('salaries.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('employees.name', 'like', "%{$request->get('searchSalary')}%")
                                ->orWhere('salaries.year', 'like', "%{$request->get('searchSalary')}%")
                                ->orWhere('salaries.month', 'like', "%{$request->get('searchSalary')}%")
                                ->orWhere('salaries.salary', 'like', "%{$request->get('searchSalary')}%")
                                ->orWhere('salaries.salary_warranty', 'like', "%{$request->get('searchSalary')}%")
                                ->orWhere('salaries.warranty_secretariats', 'like', "%{$request->get('searchSalary')}%")
                                ->orWhere('salaries.warranty_contributions', 'like', "%{$request->get('searchSalary')}%")
                                ->orWhere('salaries.created_at', 'like binary', "%{$request->get('searchSalary')}%");
                        });
                }
                if ($request->has('employeeId') and $request->get('employeeId') != "") {
                    $tasks->where('employees.id', '=', "{$request->get('employeeId')}");
                }
                if ($request->has('monthId') and $request->get('monthId') != "") {
                    $tasks->where('salaries.month', '=', "{$request->get('monthId')}");
                }
                if ($request->has('moneyId') and $request->get('moneyId') != "") {
                    $tasks->where('salaries.year', '=', "{$request->get('moneyId')}");
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
        return $model->newQuery()->leftJoin('employees', 'employees.id','=','salaries.employee_id')
            ->select([ 'salaries.id', 'employees.name as employee_id', 'salaries.year', 'salaries.month', 'salaries.salary','salaries.salary_warranty','salaries.warranty_secretariats','salaries.warranty_contributions', 'salaries.created_at'])
            ->where('salaries.isdelete','=','0');
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
        return 'Salary_' . date('YmdHis');
    }
}
