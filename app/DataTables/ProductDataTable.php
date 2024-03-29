<?php
namespace App\DataTables;
use App\Product;
//use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Services\DataTable;
class ProductDataTable extends DataTable
{
    public function dataTable(DataTables $dataTables, $query)
    {
        return datatables($query)
            ->addColumn('actions', 'Admin.products.buttons.actions')
            ->addColumn('image', 'Admin.products.buttons.image')
            ->addColumn('checkbox', 'Admin.products.buttons.checkbox')
            ->addColumn('approved', 'Admin.products.buttons.approved')
            ->rawColumns(['checkbox','show_action','approved','actions','image','date']);
    }

	public function query(Product $model)
    {
        return $model->newQuery()->select('name->en as ss','slug',
        'image','product_type','approved','id','has_accessories','sale_price');        ;
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
                    [
                        'text'      => '<i class="fa fa-trash"></i> '.trans('admin.delete'),
                        'className' => 'btn red btn-outline delBtn'
                    ], [
                        'text' => '<i class="fa fa-plus"></i> '.trans('admin.add'),
                        'className'    => 'btn btn-primary',
                        'action'    => 'function(){
                        	window.location.href =  "'.\URL::current().'/create";
                        }',
                    ],
                ],
                'initComplete' => "function () {
                this.api().columns([1,3,4]).every(function () {
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
                       'sProcessing' => trans('admin.sProcessing'),
							'sLengthMenu'        => trans('admin.sLengthMenu'),
							'sZeroRecords'       => trans('admin.sZeroRecords'),
							'sEmptyTable'        => trans('admin.sEmptyTable'),
							'sInfo'              => trans('admin.sInfo'),
							'sInfoEmpty'         => trans('admin.sInfoEmpty'),
							'sInfoFiltered'      => trans('admin.sInfoFiltered'),
							'sInfoPostFix'       => trans('admin.sInfoPostFix'),
							'sSearch'            => trans('admin.sSearch'),
							'sUrl'               => trans('admin.sUrl'),
							'sInfoThousands'     => trans('admin.sInfoThousands'),
							'sLoadingRecords'    => trans('admin.sLoadingRecords'),
							'oPaginate'          => [
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
                    'name'       => 'checkbox',
                    'data'       => 'checkbox',
                    'title'      => '<input type="checkbox" class="check_all" onclick="check_all()" />',
                    'exportable' => false,
                    'printable'  => false,
                    'orderable'  => false,
                    'searchable' => false,
                ],
                [
                    'name'=>'id',
                    'data'=>'id',
                    'title'=>'#',
            ],
            [
                'name'=>'image',
                'data'=>'image',
                'title'=>trans('admin.image'),
                ],
                [
                    'name'  => 'name',
                    'data'  => 'ss',
                    'title' => trans('admin.name'),

                ],
                [
                    'name'  => 'slug',
                    'data'  => 'slug',
                    'title' => trans('admin.slug'),
                ],
                [
                    'name'  => 'sale_price',
                    'data'  => 'sale_price',
                    'title' => trans('admin.sale_price'),
                ],
                [
                    'name'  => 'approved',
                    'data'  => 'approved',
                    'title' => trans('admin.approved'),
                ],

 [
	                'name'       => 'actions',
	                'data'       => 'actions',
	                'title'      => trans('admin.actions'),
	                'exportable' => false,
	                'printable'  => false,
	                'searchable' => false,
	                'orderable'  => false,
	            ]
	        ];
	    }


	    /**
	     * Get filename for export.
	     * Auto filename Method By Baboon Script
	     * @return string
	     */
	    protected function filename()
	    {
	        return 'products_' . time();
	    }

}
