<?php

namespace App\DataTables;

use App\Order;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrdersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'dashboard.orders.cols.action')
            ->addColumn('change_status','dashboard.orders.cols.change_status')

            ->rawColumns([
                'action','change_status'
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
        return $model->newQuery()->latest()->with(['province','products','user'])->select('orders.*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('orders-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->parameters([
                        
                    'dom' => 'Blfrtip',
                   'lengthMenu' => [[5,10,25,50,100,-1],[5,10,25,50,100,'All Records']],
                    'buttons' => [
                   
                    
                    ['extend' => 'reload','className'=>'btn btn-primary mb-3','text'=>'<i class="fa fa-refresh"></i>'],
                    ['extend' => 'print','className'=>'btn btn-info','text'=>'<i class="fa fa-print"></i> Print Table'],
                    ['extend' => 'excel','className'=>'btn btn-default','text'=>'<i class="fa fa-file"></i> Excel'],
                    ['extend' => 'csv','className'=>'btn btn-warning','text'=>'<i class="fa fa-file"></i> CSV'],
                    

                ],


                'initComplete' => "function () {
                    this.api().columns([8]).every(function () {
                        var column = this;
                        var input = document.createElement('input');
                        $(input).appendTo($(column.footer()).empty())
                        .on('keyup', function () {
                            column.search($(this).val(), false, false, true).draw();
                        });
                    });
                }",
                
                

            ]);

       
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            [
                "name" => "orderId",
                'data' => 'orderId',
                'title' => trans('software.orderId'),
            ],

            [
                "name" => "total_commission",
                'data' => 'total_commission',
                'title' => trans('software.total_commission'),
                'printable' => false,
                'exportable' => false,
            ],
            
            [
                "name" => "change_status",
                'data' => 'change_status',
                'title' => trans('software.change_status'),
                'printable' => false,
                'exportable' => false,
            ],

            [
                "name" => "status",
                'data' => 'status',
                'title' => trans('software.status'),
                'printable' => false,
                'exportable' => false,
            ],


            [
                'name' => 'shipping_status',
                'data' => 'shipping_status',
                'title' => trans('software.shipping_status'),
                'printable' => false,
                'exportable' => false,
            ],

            [
                'name' => 'client_address',
                'data' => 'client_address',
                'title' => trans('software.client_address'),
            ],

            [
                'name' => 'client_phone1',
                'data' => 'client_phone1',
                'title' => trans('software.client_phone1'),
            ],

            [
                'name' => 'client_phone2',
                'data' => 'client_phone2',
                'title' => trans('software.client_phone2'),
            ],




           


           



            
            [
                "name" => "created_at",
                'data' => 'created_at',
                'title' => trans('software.created_at'),
                'printable' => false,
                'exportable' => false,
            ],

            

            

            [
                "name" => "action",
                'data' => 'action',
                'title' => trans('software.controls'),
                'orderable' => false,
                'printable' => false,
                'searchable' => false,
            ],

           
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Orders_' . date('YmdHis');
    }
}
