<?php

namespace App\DataTables\Frontend\Ranking;

use App\HideRanking;
use App\HideRankingGuild;
use App\Http\Model\SRO\Shard\Char;
use App\Http\Model\SRO\Shard\Guild;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class GuildsRankingDataTable extends DataTable
{
    /**
     * @var int
     */
    private int $count;

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->editColumn('id', function ($data = '$query') {
                return ++$this->count;
            })
            ->editColumn('guild', function ($data = '$query') {
                return '
                <a href="' . route('information-guild', ['name' => Str::lower($data->Name)]) . '"
                   target="_blank">
                   ' . $data->Name . '
                    <i class="fas fa-external-link-alt"></i>
                </a>';
            })
            ->addIndexColumn()
            ->escapeColumns()
            ->rawColumns([
                'guild',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $this->count = 0;
		
        // check for hide ranking and add deleted_chars to it
        $hideRanking = HideRanking::all()
            ->pluck('charname');

        //check for hidden guilds from ranking.
        $hideRankingGuild = HideRankingGuild::all()
            ->pluck('guild_id')
            ->diff([0]);

        $query = Guild::whereNotIn('id', $hideRankingGuild)
            ->where('id', '!=', 0)
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
                'order' => [[0, 'desc']],
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
                ->title(__('ranking.table.rank'))
                ->footer(__('ranking.table.rank'))
                ->visible(true)
                ->orderable(false)
                ->width(60),
            Column::make('guild')
                ->name('guild')
                ->title(__('ranking.table.guild'))
                ->footer(__('ranking.table.guild'))
                ->visible(true)
                ->orderable(true),
            Column::make('Lvl')
                ->name('Lvl')
                ->title(__('ranking.table.level'))
                ->footer(__('ranking.table.level'))
                ->visible(true)
                ->orderable(true),
            Column::make('ItemPoints')
                ->name('ItemPoints')
                ->title(__('ranking.table.itempoints'))
                ->footer(__('ranking.table.itempoints'))
                ->visible(true)
                ->orderable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Frontend/Ranking_' . date('YmdHis');
    }
}
