<?php

namespace App\DataTables\Frontend\Account;

use App\UserVoucher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class VouchersDataTable extends DataTable
{
    /**
     * @var int|mixed|null
     */
    private $id;


    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->editColumn('id', function () {
                return ++$this->id;
            })
            ->editColumn('redeemed_at', function ($data = '$query') {
                return Carbon::make($data->redeemed_at)->diffForHumans();
            })
            ->escapeColumns()
            ->rawColumns([
                'id',
                'redeemed_at'
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     */
    public function query()
    {
        $this->id = 0;
        $query = UserVoucher::where('user_id', Auth::id())
            ->with('getVoucher')
            ->get();
        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
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
            Column::make('id')
                ->name('id')
                ->title('#')
                ->footer('#')
                ->visible(true)
                ->orderable(true)
                ->width(60)
                ->searchable(false),
            Column::make('get_voucher.code')
                ->name('get_voucher.code')
                ->title(__('home.voucher.table.voucher'))
                ->footer(__('home.voucher.table.voucher'))
                ->visible(true)
                ->addClass('align-middle')
                ->orderable(true)
                ->searchable(true),
            Column::make('get_voucher.amount')
                ->name('get_voucher.amount')
                ->title(__('home.voucher.table.amount'))
                ->footer(__('home.voucher.table.amount'))
                ->visible(true)
                ->addClass('align-middle')
                ->orderable(true)
                ->searchable(true),
            Column::make('redeemed_at')
                ->name('redeemed_at')
                ->title(__('home.voucher.table.used-at'))
                ->footer(__('home.voucher.table.used-at'))
                ->visible(true)
                ->width(200)
                ->addClass('align-middle')
                ->orderable(true)
                ->searchable(true),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Frontend/AuctionHouse/AuctionHouse_' . date('YmdHis');
    }
}
