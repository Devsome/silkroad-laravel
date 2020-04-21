<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DiscordController extends Controller
{
    /**
     * Discord Server ID
     * @var null
     */
    private $discordServerId;

    /**
     * DiscordController constructor.
     */
    public function __construct()
    {
        $this->setDiscordServerId(config('siteSettings.discord_server_id', '674395399011827712'));
    }

    /**
     * Fetching the Discord Server
     * @return mixed|null
     */
    public function fetch()
    {
        $seconds = 60 * 60; // 1 hour

        if($this->getDiscordServerId()) {
            $discordFetch = Cache::remember('discordFetch', $seconds, function () {
                $raw = file_get_contents(
                    'https://discordapp.com/api/servers/' .
                    $this->getDiscordServerId() .
                    '/widget.json'
                );
                return json_decode($raw, true);
            });
        } else {
            $discordFetch = null;
        }

        return $discordFetch;
    }

    /**
     * @return null
     */
    public function getDiscordServerId()
    {
        return $this->discordServerId;
    }

    /**
     * @param null $discordServerId
     */
    public function setDiscordServerId($discordServerId): void
    {
        $this->discordServerId = $discordServerId;
    }
}
