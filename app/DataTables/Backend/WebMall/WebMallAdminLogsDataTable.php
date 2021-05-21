<?php

namespace App\DataTables\Backend\WebMall;

use App\Model\Backend\ItemWebMallAdminLog;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class WebMallAdminLogsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query): DataTableAbstract
    {
        return datatables($query)
            ->editColumn('type', function ($data = '$query') {
                return (($data->type === 'add') ? "Add" : "Delete");
            })
            ->editColumn('data', function ($data = '$query') {
                if ($data->type === 'add') {
                    return "Created Item " . $data->data['item_code'] . " With Price of " . $data->data['silk_price'] . " And item quantity is " . $data->data['item_quantity'] . " and item plus is " . $data->data['item_plus'];
                }
                return "Deleted Item " . $data->data['CodeName128'] . " With Price of " . $data->data['silk_price'] . " And item quantity is " . $data->data['item_quantity'] . " and item plus is " . $data->data['item_plus'];
            })
            ->editColumn('created_at', function ($data = '$query') {
                return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->diffForHumans();
            })
            ->escapeColumns()
            ->rawColumns([
                'type',
                'Data',
                'created_at',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @return Builder
     */
    public function query()
    {
        $query = ItemWebMallAdminLog::orderBy('created_at', 'DESC')
            ->with('user')
            ->get();
        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): \Yajra\DataTables\Html\Builder
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
    protected function getColumns(): array
    {
        return [
            Column::make('id')
                ->name('id')
                ->title('#')
                ->footer('#')
                ->visible(true)
                ->orderable(true)
                ->searchable(true)
                ->width(40),
            Column::make('user.name')
                ->name('user.name')
                ->title(__('webmall/webmall.backend.datatable.user'))
                ->footer(__('webmall/webmall.backend.datatable.user'))
                ->visible(true)
                ->addClass('align-middle')
                ->orderable(true)
                ->searchable(true)
                ->width(120),
            Column::make('type')
                ->name('type')
                ->title(__('webmall/webmall.backend.datatable.type'))
                ->footer(__('webmall/webmall.backend.datatable.type'))
                ->visible(true)
                ->addClass('align-middle')
                ->orderable(true)
                ->searchable(true)
                ->width(60),
            Column::make('data')
                ->name('data')
                ->title(__('webmall/webmall.backend.datatable.data'))
                ->footer(__('webmall/webmall.backend.datatable.data'))
                ->visible(true)
                ->addClass('align-middle')
                ->orderable(true)
                ->searchable(true),
            Column::make('created_at')
                ->name('created_at')
                ->title(__('webmall/webmall.backend.datatable.created_at'))
                ->footer(__('webmall/webmall.backend.datatable.created_at'))
                ->visible(true)
                ->addClass('align-middle')
                ->orderable(true)
                ->searchable(true)
                ->width(120),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Backend/WebMall/WebMallAdminLogs_' . date('YmdHis');
    }
}
