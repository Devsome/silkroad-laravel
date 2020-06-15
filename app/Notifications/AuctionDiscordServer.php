<?php

namespace App\Notifications;

use App\Model\Frontend\AuctionItem;
use App\Model\Frontend\CharInventory;
use Awssat\Notifications\Messages\DiscordMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AuctionDiscordServer extends Notification
{
    use Queueable;

    /**
     * @var AuctionItem
     */
    protected $auctionItem;

    /**
     * @var CharInventory
     */
    protected $charInventory;

    /**
     * Create a new notification instance.
     *
     * @param AuctionItem $auctionItem
     * @param CharInventory $charInventory
     */
    public function __construct(AuctionItem $auctionItem, CharInventory $charInventory)
    {
        $this->auctionItem = $auctionItem;
        $this->charInventory = $charInventory;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['discord'];
    }

    /**
     * @param $notifiable
     * @return DiscordMessage
     */
    public function toDiscord($notifiable): DiscordMessage
    {
        $charInventory = $this->charInventory;
        $auctionItem = $this->auctionItem;

        $route = route('auctions-house-show-item', [
            'id' => $auctionItem->id
        ]);
        $route = 'https://silkroad-laravel.de/test';

        $discordMessage = new DiscordMessage();
        $discordMessage->from('Auctions House');
        $discordMessage->embed(static function ($embed) use($charInventory, $auctionItem, $route) {
            $embed
                ->author($charInventory->name,
                    $route
//                    $charInventory->imgpath
                )
                ->color('ff0000')
                ->footer('Until: ' . $auctionItem->until)

                ->field('Bid Price', $auctionItem->price, false)
                ->field('Buy now Price', $auctionItem->price_instead, false)
                ->field('Plus', $charInventory->optlevel, true)
                ->field('Sox', $charInventory->special ? 'Yes' : 'No', true)
                ->field('Degree', $charInventory->degree, true)
                ->field('Type', $charInventory->sort, true);
        });

        return $discordMessage;
    }
}
