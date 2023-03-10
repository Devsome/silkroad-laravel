<?php

namespace App\DataTables\Frontend\Ranking;

use App\HideRanking;
use App\HideRankingGuild;
use App\Http\Model\SRO\Shard\Char;
use App\Http\Model\SRO\Shard\CharTrijob;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class HunterRankingDataTable extends DataTable
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
            ->editColumn('name', function ($data = '$data') {
                return '
                <span>
                <img src="' . route('images.characters', ['image' => $data->getCharacter->RefObjID.'.gif']) . '" loading="lazy" class="img-fluid d-none d-sm-inline" width="16" height="16" alt="' . $data->getCharacter->CharName16 . '"/>
                 ' . $data->getCharacter->NickName16 . '
                 </span>
                ';
            })
            ->editColumn('type', 'Hunter')
            ->editColumn('level', function ($data = '$query'){
                return __('ranking.table.job-level', ['level' => $data->Level, 'exp' => $data->Exp]);
            })
            ->addIndexColumn()
            ->escapeColumns()
            ->rawColumns([
                'name',
                'type',
                'level',
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

        $query = CharTrijob::whereHas('getCharacter', static function ($q) use ($hideRanking, $hideRankingGuild) {
            $q->whereNotIn('CharName16', $hideRanking)
				->where('Deleted', false)
				->whereNotIn('GuildID', $hideRankingGuild);
        })
            ->with('getCharacter')
            ->where('JobType', 3)
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
                'order' => [[3, 'desc']],
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
            Column::make('DT_RowIndex')
                ->name('DT_RowIndex')
                ->title(__('ranking.table.rank'))
                ->footer(__('ranking.table.rank'))
                ->visible(true)
                ->orderable(false)
                ->width(60),
            Column::make('name')
                ->name('name')
                ->title(__('ranking.table.job-name'))
                ->footer(__('ranking.table.job-name'))
                ->visible(true)
                ->width(150)
                ->orderable(true),
            Column::make('type')
                ->name('type')
                ->title(__('ranking.table.job-type'))
                ->footer(__('ranking.table.job-type'))
                ->visible(true)
                ->orderable(true),
            Column::make('level')
                ->name('level')
                ->title(__('ranking.table.exp'))
                ->footer(__('ranking.table.exp'))
                ->visible(true)
                ->orderable(true),
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
