<?php
/**
 * Date: 25.11.2016
 * Time: 15:19
 */

namespace App\Zabor\Items;


use App\Zabor\Notifier;
use Telegram\Bot\Api;

class ItemNotifier
{
    /**
     * @var Notifier
     */
    private $notifier;

    /**
     * ItemNotifier constructor.
     * @param Notifier $notifier
     */
    public function __construct(Notifier $notifier)
    {
        $this->notifier = $notifier;
    }

    /**
     * @param $item
     * @param $description
     */
    public function notifyNewItem($item, $description)
    {
        $active = $item->b_active ? 'active' : 'inactive';

        $message = sprintf(
            'New %s ad: <a href="%s">%s</a>',
            $active,
            $item->show_link,
            $description->s_title
        );

        $this->notifier->notify($message);
    }
}