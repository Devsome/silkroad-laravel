<?php

namespace App\DataTables\Backend\WebMall;

use App\Http\Library\Services\SRO\Shard\InventoryService;
use App\Http\Model\SRO\Shard\RefObjCommon;
use App\Http\Model\SRO\Shard\RefObjItem;
use App\Model\Backend\ItemWebMall;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class WebMallDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->editColumn('item_data', function ($data = '$query') {
                return (($data->tooltip) ? htmlspecialchars_decode(stripslashes($data->tooltip)) : "");
            })
            ->editColumn('silk_price', function ($data = '$query') {
                return $data->silk_price . " " . config('siteSettings.sro_silk_name', 'Silk');
            })
            ->editColumn('created_at', function ($data = '$query') {
                return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->diffForHumans();
            })
            ->addColumn('action', '
                <button class="btn btn-danger btn-circle btn-sm" onclick="DeleteData({{$id}})">
                    <i class="fa fa-trash"></i>
                </button>
            ')
            ->escapeColumns()
            ->rawColumns([
                'item_data',
                'silk_price',
                'created_at',
                'action',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @return Builder
     */
    public function query()
    {
        $query = ItemWebMall::orderBy('created_at', 'DESC')
            ->get();
        return $this->applyScopes($query);
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
            ->parameters([
                'dom' => 'Bfrltip',
                'order' => [[0, 'asc']],
                'orderable' => true,
                'responsive' => true,
                "processing" => true,
                "info" => true,
                "searching" => true,
                'select' => false,
                "lengthMenu" => [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, __('datatables.show-all')]],
                'language' => [
                    'search' => __('datatables.search'),
                    'zeroRecords' => __('datatables.zero'),
                    "info" => __('datatables.info'),
                    "infoEmpty" => __('datatables.empty'),
                    "infoFiltered" => __('datatables.info-filtered'),
                    "paginate" => [
                        "first" => __('datatables.first'),
                        "last" => __('datatables.last'),
                        "next" => ">",
                        "previous" => "<"
                    ],
                    'searchPlaceholder' => __('datatables.searchPlaceholder'),
                    'lengthMenu' => __('datatables.length'),
                    'processing' => __('datatables.processing'),
                    'buttons' => [
                        'reload' => __('datatables.reload'),
                        'print' => __('datatables.print'),
                        'colvis' => __('datatables.colvis'),
                    ]
                ],
                'buttons' => [
                    'reload',
                    'print',
                    'colvis',
                ],
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
            Column::make('item_data')
                ->name('item_data')
                ->title(__('webmall/webmall.backend.datatable.item'))
                ->footer(__('webmall/webmall.backend.datatable.item'))
                ->visible(true)
                ->orderable(true)
                ->searchable(true),
            Column::make('CodeName128')
                ->name('CodeName128')
                ->title(__('webmall/webmall.backend.datatable.itemcode'))
                ->footer(__('webmall/webmall.backend.datatable.itemcode'))
                ->visible(true)
                ->addClass('align-middle')
                ->orderable(true)
                ->searchable(true),
            Column::make('item_name')
                ->name('item_name')
                ->title(__('webmall/webmall.backend.datatable.name'))
                ->footer(__('webmall/webmall.backend.datatable.name'))
                ->visible(true)
                ->addClass('align-middle')
                ->orderable(true)
                ->searchable(true),
            Column::make('silk_price')
                ->name('silk_price')
                ->title(__('webmall/webmall.backend.datatable.price'))
                ->footer(__('webmall/webmall.backend.datatable.price'))
                ->visible(true)
                ->addClass('align-middle')
                ->orderable(true)
                ->searchable(true),
            Column::make('item_plus')
                ->name('item_plus')
                ->title(__('webmall/webmall.backend.datatable.itemplus'))
                ->footer(__('webmall/webmall.backend.datatable.itemplus'))
                ->visible(true)
                ->addClass('align-middle')
                ->orderable(true)
                ->searchable(true),
            Column::make('created_at')
                ->name('created_at')
                ->title(__('webmall/webmall.backend.datatable.created_at'))
                ->footer(__('webmall/webmall.backend.datatable.created_at'))
                ->visible(false)
                ->addClass('align-middle')
                ->orderable(true)
                ->searchable(true),
            Column::make('action')
                ->name('action')
                ->title(__('webmall/webmall.backend.datatable.actions'))
                ->footer(__('webmall/webmall.backend.datatable.actions'))
                ->visible(true)
                ->addClass('align-middle text-center')
                ->orderable(false)
                ->searchable('false'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Backend\WebMall\WebMall_' . date('YmdHis');
    }
}
