<?php

namespace App\DataTables\Frontend\Ranking;

use App\HideRanking;
use App\HideRankingGuild;
use App\Http\Library\Services\SRO\Log\UniqueService;
use App\Http\Model\SRO\Log\PvpRecordsLog;
use App\Http\Model\SRO\Shard\Char;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FreePvpRankingDataTable extends DataTable
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
            ->editColumn('id', function ($data = '$query'){
                return ++$this->count;
            })
            ->editColumn('name', function ($data = '$query') {
                return '
                <a href="' . route('information-player', ['CharName16' => Str::lower($data->CharName)]) . '"
                   target="_blank">
                   ' . $data->CharName . '
                    <i class="fas fa-external-link-alt"></i>
                </a>';
            })
            ->escapeColumns()
            ->rawColumns([
                'name',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param UniqueService $uniqueService
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(UniqueService $uniqueService)
    {
        $this->count = 0;
        //check for deleted Characters
        $deleted_chars = Char::where('Deleted', true)
            ->pluck('CharName16');
        // check for hide ranking and add deleted_chars to it
        $hideRanking = HideRanking::all()
            ->pluck('charname')
            ->union($deleted_chars);

        //check for hidden guilds from ranking.
        $hideRankingGuild = HideRankingGuild::all()
            ->pluck('guild_id')
            ->diff([0]);

        $query = PvpRecordsLog::whereNotIn('CharName', $hideRanking)
            ->whereType(0)
            ->with([
                'getKillerCharacter' => static function ($query) use ($hideRankingGuild) {
                    $query->whereNotIn('GuildID', $hideRankingGuild);
                }
            ])
            ->select(DB::raw('count(pvp_records.CharName) as points'), 'CharName')
            ->groupBy('CharName')
            ->orderBy('points', 'DESC')
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
                ->title(__('ranking.table.rank'))
                ->footer(__('ranking.table.rank'))
                ->visible(true)
                ->orderable(true)
                ->width(60),
            Column::make('name')
                ->name('name')
                ->title(__('ranking.table.charname'))
                ->footer(__('ranking.table.charname'))
                ->visible(true)
                ->width(150)
                ->orderable(true),
            Column::make('points')
                ->name('points')
                ->title(__('ranking.table.kills'))
                ->footer(__('ranking.table.kills'))
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
        return 'Frontend / Ranking_' . date('YmdHis');
    }
}
