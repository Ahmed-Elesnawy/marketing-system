<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
            ->addColumn('action', 'dashboard.users.cols.action')
            ->addColumn('status', 'dashboard.users.cols.status')
            ->addColumn('image', 'dashboard.users.cols.image')

            ->rawColumns([
                'action','admin','status','image'
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->parameters([
                'dom' => 'Blfrtip',
                'lengthMenu' => [[10,25,50,100,-1],[10,25,50,100,'All Records']],
                'buttons' => [
                   
                    

                    ['extend' => 'print','className'=>'btn btn-info mb-3','text'=>'<i class="fa fa-print"></i> اطبع الجدول'],
                    ['extend' => 'create','className'=>'btn btn-success mb-3','text'=>'<i class="fa fa-plus"></i>اضف عضو'],
                    ['extend' => 'reload','className'=>'btn btn-primary mb-3','text'=>'<i class="fa fa-refresh"></i>'],

                    

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
                'title' => 'رقم العضو',
                'orderable' => true
            ],
            [
                "name" => "name",
                'data' => 'name',
                'title' => 'الإسم',
            ],

           

            [
                "name" => "email",
                'data' => 'email',
                'title' => 'الايميل',
               
            ],

             [
                "name" => "image",
                'data' => 'image',
                'title' => 'الصورة',
            ],

            [
                "name" => "type",
                'data' => 'type',
                'title' => trans('software.type'),
            ],

            [
                "name" => "status",
                'data' => 'status',
                'title' => 'الحاله',
            ],

            [
                'name' => 'commission',
                'data' => 'commission',
                'title'=> 'الربح(ج.م)' 
            ],

            [
                'name' => 'phone',
                'data' => 'phone',
                'title'=> trans('software.phone') 
            ],
            
            [
                "name" => "created_at",
                'data' => 'created_at',
                'title' => 'وقت الإنشاء',
            ],

            [
                "name" => "action",
                'data' => 'action',
                'title' => 'تحكم',
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
        return 'Users_' . date('YmdHis');
    }
}
