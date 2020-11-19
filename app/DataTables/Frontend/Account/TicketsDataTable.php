<?php

namespace App\DataTables\Frontend\Account;

use App\Tickets\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TicketsDataTable extends DataTable
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
            ->editColumn('updated_at', function ($data = '$query') {
                return Carbon::make($data->updated_at)->diffForHumans();
            })
            ->addColumn('actions', function ($data = '$query') {
                return '<a href="' . route('home-tickets-show', ['id' => $data->id]) . '" class="btn btn-primary btn-circle btn-sm"><i class="fa fa-eye"></i></a>';
            })
            ->escapeColumns()
            ->rawColumns([
                'updated_at',
                'actions'
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     */
    public function query()
    {
        $query = Ticket::where('user_id', Auth::id())
            ->with('getStatusName')
            ->with('getPriorityName')
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
            Column::make('title')
                ->name('title')
                ->title(__('home.tickets.table.title'))
                ->footer(__('home.tickets.table.title'))
                ->visible(true)
                ->addClass('align-middle')
                ->orderable(true)
                ->searchable(true),
            Column::make('get_status_name.name')
                ->name('get_status_name.name')
                ->title(__('home.tickets.table.state'))
                ->footer(__('home.tickets.table.state'))
                ->visible(true)
                ->addClass('align-middle')
                ->orderable(true)
                ->searchable(true),
            Column::make('get_priority_name.name')
                ->name('get_priority_name.name')
                ->title(__('home.tickets.table.priority'))
                ->footer(__('home.tickets.table.priority'))
                ->visible(true)
                ->addClass('align-middle')
                ->orderable(true)
                ->searchable(true),
            Column::make('updated_at')
                ->name('updated_at')
                ->title(__('home.tickets.table.updated-at'))
                ->footer(__('home.tickets.table.updated-at'))
                ->visible(true)
                ->width(200)
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
                ->searchable('false')
                ->width(50),
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
