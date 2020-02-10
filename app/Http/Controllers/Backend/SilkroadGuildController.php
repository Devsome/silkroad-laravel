<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\SRO\Shard\Guild;
use App\Model\SRO\Shard\GuildMember;
use Yajra\DataTables\DataTables;

/**
 * Class SilkroadGuildController
 * @package App\Http\Controllers\Backend
 */
class SilkroadGuildController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexSroGuild()
    {
        return view('backend.silkroad.guild.index');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function sroGuildDatatables()
    {
        return DataTables::of(Guild::query())->make(true);
    }

    /**
     * @param $guildId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sroGuildEdit($guildId)
    {
        $guild = Guild::findOrFail($guildId);
        return view('backend.silkroad.guild.edit', [
            'guild' => $guild
        ]);
    }

    /**
     * @param $guildId
     * @return mixed
     * @throws \Exception
     */
    public function sroGuildEditDatatables($guildId)
    {
        return DataTables::of(GuildMember::where('GuildID', $guildId))->make(true);
    }

}
