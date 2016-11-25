<?php
/**
 * Date: 25.11.2016
 * Time: 15:21
 */

namespace App\Zabor;


use Telegram\Bot\Api;

class Notifier
{
    /**
     * @var Api
     */
    private $api;

    /**
     * TelegramNotifier constructor.
     * @param Api $api
     */
    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    /**
     * @param $message
     */
    public function notify($message)
    {
        if(env('APP_ENV') == 'local'){
            $this->api->sendMessage([
                'chat_id'       => config('telegram.chat_id'),
                'text'          => $message,
                'parse_mode'    => 'HTML'
            ]);
        }
    }
}