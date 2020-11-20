<?php

namespace App\DataTables\Frontend\AuctionHouse;

use App\Model\Frontend\AuctionItem;
use Carbon\Carbon;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AuctionHouseDataTable extends DataTable
{
    /**
     * @var mixed|null
     */
    private $mode_type;


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
                return '
                    <div id="selectInventory">
                        <div class="itemslot float-none mx-auto">
                            <div class="image" style="background:url(' . $data->getItemInformation->imgpath . ')no-repeat; background-size: 34px 34px !important; width: 34px; height: 34px !important;" data-iteminfo="1">
                                <span class="qinfo">
                                    ' . (($data->getItemInformation->amount) ?? $data->getItemInformation->amount) . '
                                </span>
                                ' . (($data->getItemInformation->special) ? '<span class="plus"></span>' : "") . '
                            </div>
                        </div>
                        <div class="itemInfo">
                        ' . (($data->getItemInformation->data) ? htmlspecialchars_decode(stripslashes($data->getItemInformation->data)) : "") . '
                        </div>
                    </div>
                ';
            })
            ->editColumn('name', function ($data = '$query') {
                return '
                <a href="' . route('auctions-house-show-item', ['id' => $data->id]) . '">
                   ' . $data->getItemInformation->name . '
                </a>
                ';
            })
            ->editColumn('price', function ($data = '$query') {
                return number_format($data->price, 0, ',', '.');
            })
            ->editColumn('price_instead', function ($data = '$query') {
                return number_format($data->price_instead, 0, ',', '.');
            })
            ->editColumn('until', function ($data = '$query') {
                return Carbon::createFromFormat('Y-m-d H:i:s', $data->until)->diffForHumans();
            })
            ->addColumn('actions', function ($data = '$query') {
                if ($this->mode_type && $this->mode_type === 'own') {
                    return
                        '<button class="btn btn-danger btn-circle btn-sm" onclick="DeleteData(' . $data->id . ')"><i class="fa fa-trash"></i></a>';
                } else {
                    return '-';
                }
            })
            ->escapeColumns()
            ->rawColumns([
                'item_data',
                'name',
                'price',
                'price_instead',
                'until',
                'actions',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     */
    public function query()
    {
        $mode = $this->mode;
        $this->mode_type = $mode;
        if ($mode === 'own') {
            $query = AuctionItem::where('until', '>', Carbon::now())
                ->with('getItemInformation')
                ->whereUserId(auth()->id())
                ->orderBy('until', 'ASC')
                ->get();
        } elseif ($mode === 'all') {
            $query = AuctionItem::where('until', '>', Carbon::now())
                ->with('getItemInformation')
                ->where('user_id', '!=', auth()->id())
                ->orderBy('until', 'ASC')
                ->get();
        } else {
            $type = $this->type;
            $type = ucwords(str_replace('-', ' ', $type));
            $query = AuctionItem::whereHas('getItemInformation', static function ($q) use ($type) {
                $q->where('sort', $type);
            })
                ->orderBy('until', 'ASC')
                ->get();
        }

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
                ->title(__('auctionshouse.table.item'))
                ->footer(__('auctionshouse.table.item'))
                ->visible(true)
                ->orderable(true)
                ->addClass('p-2')
                ->width(60)
                ->searchable(true),
            Column::make('name')
                ->name('name')
                ->title(__('auctionshouse.table.name'))
                ->footer(__('auctionshouse.table.name'))
                ->visible(true)
                ->width(150)
                ->addClass('align-middle')
                ->orderable(true)
                ->searchable(true),
            Column::make('price')
                ->name('price')
                ->title(__('auctionshouse.table.price'))
                ->footer(__('auctionshouse.table.price'))
                ->visible(true)
                ->addClass('align-middle')
                ->orderable(true)
                ->searchable(true),
            Column::make('price_instead')
                ->name('price_instead')
                ->title(__('auctionshouse.table.price_instead'))
                ->footer(__('auctionshouse.table.price_instead'))
                ->visible(true)
                ->addClass('align-middle')
                ->orderable(true)
                ->searchable(true),
            Column::make('until')
                ->name('until')
                ->title(__('auctionshouse.table.until'))
                ->footer(__('auctionshouse.table.until'))
                ->visible(true)
                ->addClass('align-middle')
                ->orderable(true)
                ->searchable(true),
            Column::make('actions')
                ->name('actions')
                ->title(__('auctionshouse.table.actions'))
                ->footer(__('auctionshouse.table.actions'))
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
        return 'Frontend/AuctionHouse/AuctionHouse_' . date('YmdHis');
    }
}
