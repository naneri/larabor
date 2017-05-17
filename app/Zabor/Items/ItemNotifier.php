<?php
/**
 * Date: 25.11.2016
 * Time: 15:19
 */

namespace App\Zabor\Items;


use App\Zabor\Mysql\Item;
use App\Zabor\Services\TelegramNotifier;

class ItemNotifier
{
    /**
     * @var TelegramNotifier
     */
    private $notifier;

    /**
     * ItemNotifier constructor.
     * @param TelegramNotifier $notifier
     */
    public function __construct(TelegramNotifier $notifier)
    {
        $this->notifier = $notifier;
    }

    /**
     * @param $item
     * @param $description
     */
    public function notifyNewItem(Item $item, $description)
    {
        $active = $item->b_active ? 'active' : 'inactive';

        $message = sprintf(
            'New %s ad: <a href="%s">%s</a> for %s %s',
            $active,
            $item->show_link,
            htmlentities($description->s_title),
            $item->formatedPrice(),
            $item->fk_c_currency_code
        );

        $this->notifier->notify($message);
    }
}