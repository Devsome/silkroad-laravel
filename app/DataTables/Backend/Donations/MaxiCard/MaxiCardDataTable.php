<?php

namespace App\DataTables\Backend\Donations\MaxiCard;

use App\DonationMaxiCard;
use Carbon\Carbon;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MaxiCardDataTable extends DataTable
{
    /**
     * Build DataTable class.
     * @param $query
     * @return DataTableAbstract|DataTables
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->editColumn('created_at', function ($data = '$query') {
                return Carbon::make($data->created_at)->diffForHumans();
            })
            ->addColumn('actions', '
                <div class="list-icons">
                    <div class="dropdown">
                        <a href="#" class="list-icons-item" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-bars"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                            <button class="dropdown-item" onclick="editData({{$id}})"><i class="fa fa-edit"></i> Edit</button>
                            <button class="dropdown-item" onclick="deleteData({{$id}})"><i class="fa fa-trash"></i> Delete</button>
                        </div>
                    </div>
                </div>
            ')
            ->escapeColumns()
            ->rawColumns([
                'created_at',
                'actions',
            ]);
    }

    /**
     * Get query source of dataTable.
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|mixed
     */
    public function query()
    {
        $query = DonationMaxiCard::selectRaw('*');

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html(): Builder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->setTableId('maxicard-prices')
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
                ->width(60)
                ->searchable(false),
            Column::make('name')
                ->name('name')
                ->title(__('backend/donations.method.name'))
                ->footer(__('backend/donations.method.name'))
                ->visible(true)
                ->addClass('align-middle')
                ->orderable(true)
                ->searchable(true),
            Column::make('description')
                ->name('description')
                ->title(__('backend/donations.method.description'))
                ->footer(__('backend/donations.method.description'))
                ->visible(true)
                ->addClass('align-middle')
                ->orderable(true)
                ->searchable(true),
            Column::make('price')
                ->name('price')
                ->title(__('backend/donations.method.price'))
                ->footer(__('backend/donations.method.price'))
                ->visible(true)
                ->addClass('align-middle')
                ->orderable(true)
                ->searchable(true),
            Column::make('silk')
                ->name('silk')
                ->title(__('backend/donations.method.silk'))
                ->footer(__('backend/donations.method.silk'))
                ->visible(true)
                ->addClass('align-middle')
                ->orderable(true)
                ->searchable(true),
            Column::make('created_at')
                ->name('created_at')
                ->title(__('backend/donations.logging.table.date'))
                ->footer(__('backend/donations.logging.table.date'))
                ->visible(true)
                ->width(200)
                ->addClass('align-middle')
                ->orderable(true)
                ->searchable(true),
            Column::make('actions')
                ->name('actions')
                ->title(__('backend/donations.method.action'))
                ->footer(__('backend/donations.method.action'))
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
    protected function filename(): string
    {
        return 'Backend\Donations\MaxiCard\MaxiCard_' . date('YmdHis');
    }
}
