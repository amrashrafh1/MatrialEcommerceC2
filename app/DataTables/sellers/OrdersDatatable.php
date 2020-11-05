<?php
namespace App\DataTables\sellers;
use App\Order_lines;
//use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Services\DataTable;
class OrdersDatatable extends DataTable
{
    public function dataTable(DataTables $dataTables, $query)
    {
        return datatables($query)
            ->addColumn('actions', 'FrontEnd.sellers.orders.buttons.actions')
            ->rawColumns(['show_action','actions','date']);
    }

    public function query()
    {
        return Order_lines::query()->where('seller_id', session('store'))->orderBy('id', 'desc');
    }


    public function html()
    {
        $html =  $this->builder()
            ->columns($this->getColumns())
            //->ajax('')
            ->parameters([
                'responsive'   => true,
                'dom' => 'Blfrtip',
                "lengthMenu" => [[10, 25, 50,100, -1], [10, 25, 50,100, trans('admin.all_records')]],
                'buttons' => [
                    ['extend' => 'print', 'className' => 'btn dark btn-outline', 'text' => '<i class="fa fa-print"></i> '.trans('admin.print')],
                    ['extend' => 'excel', 'className' => 'btn green btn-outline', 'text' => '<i class="fe fe-file-plus"> </i> '.trans('admin.export_excel')],
                    /*['extend' => 'pdf', 'className' => 'btn red btn-outline', 'text' => '<i class="fa fa-file-pdf-o"> </i> '.trans('admin.export_pdf')],*/
                    ['extend' => 'csv', 'className' => 'btn purple btn-outline', 'text' => '<i class="fe fe-file-plus"> </i> '.trans('admin.export_csv')],
                    ['extend' => 'reload', 'className' => 'btn blue btn-outline', 'text' => '<i class="fe fe-refresh-ccw"></i> '.trans('admin.reload')],
                ],
                'initComplete' => "function () {
                this.api().columns([1,2]).every(function () {
                var column = this;
                var input = document.createElement(\"input\");
                $(input).attr( 'style', 'width: 100%');
                $(input).attr( 'class', 'form-control');
                $(input).appendTo($(column.footer()).empty())
                .on('keyup', function () {
                    column.search($(this).val()).draw();
                });
            });
            }",
                'order' => [[1, 'desc']],

                'language' => [
                    'sProcessing'     => trans('admin.sProcessing'),
                    'sLengthMenu'     => trans('admin.sLengthMenu'),
                    'sZeroRecords'    => trans('admin.sZeroRecords'),
                    'sEmptyTable'     => trans('admin.sEmptyTable'),
                    'sInfo'           => trans('admin.sInfo'),
                    'sInfoEmpty'      => trans('admin.sInfoEmpty'),
                    'sInfoFiltered'   => trans('admin.sInfoFiltered'),
                    'sInfoPostFix'    => trans('admin.sInfoPostFix'),
                    'sSearch'         => trans('admin.sSearch'),
                    'sUrl'            => trans('admin.sUrl'),
                    'sInfoThousands'  => trans('admin.sInfoThousands'),
                    'sLoadingRecords' => trans('admin.sLoadingRecords'),
                    'oPaginate'       => [
                        'sFirst'    => trans('admin.sFirst'),
                        'sLast'     => trans('admin.sLast'),
                        'sNext'     => trans('admin.sNext'),
                        'sPrevious' => trans('admin.sPrevious'),
                    ],
                    'oAria'            => [
                        'sSortAscending'  => trans('admin.sSortAscending'),
                        'sSortDescending' => trans('admin.sSortDescending'),
                    ],
                ]
            ]);

        return $html;

    }



    protected function getColumns()
    {
        return [
            [
                'name'  => 'id',
                'data'  => 'id',
                'title' => '#',
            ],
            [
                'name'  => 'product',
                'data'  => 'product',
                'title' => trans('user.product'),
            ],
            [
                'name'  => 'quantity',
                'data'  => 'quantity',
                'title' => trans('user.quantity'),
            ],
            [
                'name'  => 'total',
                'data'  => 'total',
                'title' => trans('user.total'),
            ],
            [
                'name'  => 'order_id',
                'data'  => 'order_id',
                'title' => trans('user.order_id'),
            ],
            [
                'name'       => 'actions',
                'data'       => 'actions',
                'title'      => trans('user.show'),
                'exportable' => false,
                'printable'  => false,
                'orderable'  => false,
                'searchable' => false,
            ],
        ];
    }


    /**
     * Get filename for export.
     * Auto filename Method By Baboon Script
     * @return string
     */
    protected function filename()
    {
        return 'orders_' . time();
    }

}
