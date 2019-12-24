<?php

namespace App\Library\Services\SRO\Shard;
use App\Model\SRO\Shard\Guild;

class GuildService
{
    /**
     * @param $guildId int
     * @return Guild[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getGuild($guildId)
    {
        return Guild::all()->where('ID', '=', $guildId);
    }
}