<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class OfferDataTable extends DataTable
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
            ->addColumn('action', 'offer.action')
            ->addColumn('activeI', function ($tasks) {
                return $tasks->active==1?'ساري':'غير فعال';
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->updated_at ? with(new Carbon($tasks->updated_at))->format('d-m-Y') : with(new Carbon($tasks->created_at))->format('d-m-Y');
            })
            ->filter(function ($tasks) use ($request) {
                if ($request->has('searchOffer') and $request->get('searchOffer') != "") {
                    $tasks->where('offers.isdelete','=','0')
                        ->where(function ($tasks) use ($request){
                            $tasks->where('offers.title', 'like', "%{$request->get('searchOffer')}%")
                                ->orWhere('options.title', 'like', "%{$request->get('searchOffer')}%")
                                ->orWhere('offers.amount', 'like', "%{$request->get('searchOffer')}%")
                                ->orWhere('offers.discount_r', 'like', "%{$request->get('searchOffer')}%")
                                ->orWhere('offers.discount_v', 'like', "%{$request->get('searchOffer')}%")
                                ->orWhere('offers.total', 'like', "%{$request->get('searchOffer')}%")
                                ->orWhere('offers.created_at', 'like binary', "%{$request->get('searchOffer')}%")
                                ->orWhere('us.name', 'like', "%{$request->get('searchOffer')}%")
                                ->orWhere('u.name', 'like', "%{$request->get('searchOffer')}%");
                        });
                }
                if ($request->has('typeId') and $request->get('typeId') != "") {
                    $tasks->where('options.id', '=', "{$request->get('typeId')}");
                }
                if ($request->has('activeId') and $request->get('activeId') != "") {
                    $tasks->where('offers.active', '=', "{$request->get('activeId')}");
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
        return $model->newQuery()->leftJoin('options', 'options.id','=','offers.type')
            ->leftJoin('users as us', 'us.id','=','offers.created_by')
            ->leftJoin('users as u', 'u.id','=','offers.updated_by')
            ->select([ 'offers.id', 'offers.date', 'offers.title', 'options.title as type', 'offers.fees_reg', 'offers.fees_bag', 'offers.fees_course', 'offers.amount', 'offers.discount_r', 'offers.discount_v', 'offers.total', 'offers.active', 'offers.created_at', 'offers.updated_at', 'us.name as created_by', 'u.name as updated_by'])
            ->where('offers.isdelete','=','0');
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
        return 'Offer_' . date('YmdHis');
    }
}
