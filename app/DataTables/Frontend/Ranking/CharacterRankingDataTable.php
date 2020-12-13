<?php

namespace App\DataTables\Frontend\Ranking;

use App\HideRanking;
use App\HideRankingGuild;
use App\Http\Model\SRO\Shard\Char;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CharacterRankingDataTable extends DataTable
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
            ->editColumn('char', function ($data = '$query') {
                return '
                <img src="' . asset('image/sro/chars/' . $data->RefObjID . '.gif') .
                    '" loading="lazy" class="img-fluid d-none d-sm-inline" width="16" height="16" alt="' .
                    $data->CharName16 . '">
                <a href="' . route('information-player', ['CharName16' => Str::lower($data->CharName16)]) . '">
                 ' . $data->CharName16 . '</a>
                <a class="small" href="' . route('information-player', [
                        'CharName16' => Str::lower($data->CharName16)]) . '" target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                </a>
                ';
            })
            ->editColumn('guild', function ($data = '$query') {
                if (isset($data->getGuildUser)) {
                    return '
                <a class="small" href="' . route('information-guild', [
                            'name' => Str::lower($data->getGuildUser->Name)]) . '" target="_blank">
                ' . $data->getGuildUser->Name . '
                </a>';
                }
                return "-";
            })
            ->escapeColumns()
            ->rawColumns([
                'char',
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

        $query = Char::whereNotIn('CharName16', $hideRanking)
            ->whereNotIn('GuildID', $hideRankingGuild)
            ->with('getGuildUser')
            ->orderBy('ItemPoints', 'DESC')
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
            Column::make('char')
                ->name('char')
                ->title(__('ranking.table.charname'))
                ->footer(__('ranking.table.charname'))
                ->visible(true)
                ->width(150)
                ->orderable(true),
            Column::make('guild')
                ->name('guild')
                ->title(__('ranking.table.guild'))
                ->footer(__('ranking.table.guild'))
                ->visible(true)
                ->orderable(true),
            Column::make('CurLevel')
                ->name('CurLevel')
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
