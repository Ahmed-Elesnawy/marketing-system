<?php

namespace App\DataTables;

use App\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductsDataTable extends DataTable
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
            ->addColumn('action', 'dashboard.products.cols.action')
            ->addColumn('image','dashboard.products.cols.image')
            ->rawColumns([
                'action','image'
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->newQuery()
               ->with('category')
               ->select('products.*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('products-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->parameters([
                'dom' => 'Blfrtip',
                'lengthMenu' => [[10,25,50,100,-1],[10,25,50,100,'All Records']],
                'buttons' => [
                   
                    

                    ['extend' => 'create','className'=>'btn btn-success mb-3','text'=> "<i class='fa fa-plus'></i> ". trans('software.add_product') ],

                    

                ],
                
                

            ]);

        /*
        ->buttons(
            Button::make('create'),
            Button::make('print'),
            Button::make('reload')
        );*/
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
                "name" => "id",
                'data' => 'id',
                'title' => trans('software.id'),
                'orderable' => true
            ],
            [
                "name" => "name",
                'data' => 'name',
                'title' => trans('software.name'),
            ],

            [
                "name" => "category.name_ar",
                'data' => 'category.name_ar',
                'title' => trans('software.category'),
            ],

            [
                "name" => "image",
                'data' => 'image',
                'title' => trans('software.image'),
            ],

             [
                "name" => "price",
                'data' => 'price',
                'title' => trans('software.price'),
            ],

             [
                "name" => "commission",
                'data' => 'commission',
                'title' => trans('software.commission'),
            ],
             [
                "name" => "stock",
                'data' => 'stock',
                'title' => trans('software.stock'),
            ],
                           
            [
                "name" => "created_at",
                'data' => 'created_at',
                'title' => trans('software.created_at'),
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
        return 'Products_' . date('YmdHis');
    }
}
