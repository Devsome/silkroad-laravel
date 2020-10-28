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

        $discordMessage = new DiscordMessage();
        $discordMessage->from('Auctions House');
        $discordMessage->embed(static function ($embed) use($charInventory, $auctionItem, $route) {
            $embed
                ->author($charInventory->name,
                    $route,
                    $charInventory->imgpath
                )
                ->color('ff0000')
                ->footer('Until: ' . data_get($auctionItem, 'until', 'Unknown'))

                ->field('Bid Price', data_get($auctionItem, 'price', 'Unknown'), false)
                ->field('Buy now Price', data_get($auctionItem, 'price_instead', 'Unknown'), false)
                ->field('Plus', data_get($auctionItem, 'optlevel', 'Unknown'), true)
                ->field('Sox', data_get($auctionItem, 'special', false) ? 'Yes' : 'No', true)
                ->field('Degree', data_get($auctionItem, 'degree', 'Unknown'), true)
                ->field('Type', data_get($auctionItem, 'sort', 'Unknown'), true);
        });

        return $discordMessage;
    }
}
