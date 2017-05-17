<?php
/**
 * Date: 25.11.2016
 * Time: 15:21
 */

namespace App\Zabor;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
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
        if(env('APP_ENV') == 'production'){
            try{
                $this->api->sendMessage([
                    'chat_id'       => config('telegram.chat_id'),
                    'text'          => $message,
                    'parse_mode'    => 'HTML'
                ]);
            }catch (\Exception $e){
                Bugsnag::notifyException($e);
            }
        }
    }
}