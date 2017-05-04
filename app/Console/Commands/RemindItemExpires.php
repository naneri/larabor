<?php

namespace App\Console\Commands;

use App\Zabor\Mysql\Item;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Cache;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Mail;

class RemindItemExpires extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'items:remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reminds users of old ads, that their Items might expire';

    /**
     * RemindItemExpires constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Cache::forever('old-items', 0);

        Item::where('dt_expiration', '<', Carbon::now()->addDays(5))
            ->where('dt_expiration', '>', Carbon::now()->addDays(4))
            ->where('b_enabled', 1)
            ->where('b_active', 1)
            ->whereNull('fk_i_user_id')
            ->with('description')
            ->chunk(20, function ($items){
                foreach($items as $item){
                    Cache::increment('old-items');
                    try{
                        Mail::send('emails.item.remind', compact('item'), function($message) use ($item){
                            $message->to($item->s_contact_email)->subject('Ваше обьявление скоро устареет!');
                        });
                    }catch (\Exception $e){
                        Bugsnag::notifyException($e);
                    }
                }
            });
    }
}
