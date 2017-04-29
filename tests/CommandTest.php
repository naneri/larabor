<?php

use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommandTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @test
     */
    function test_it_reminds_correctly()
    {
        $this->seed();

        factory(App\Zabor\Mysql\Item::class, 7)->create([
            'dt_expiration' =>  Carbon::now()->addDays(4)->addHours(4)
        ])->each(function ($item) {
            $item->description()->save(factory(App\Zabor\Mysql\ItemDescription::class)->make());
        });

        /**
         * first checking that items
         */
        Artisan::call('items:remind');
        $this->assertEquals(7, Cache::get('old-items'));

        $now = Carbon::now()->toDateTimeString();

        /**
         * check for tomorrow
         */
        Carbon::setTestNow(Carbon::parse($now)->addDays(1));

        Artisan::call('items:remind');
        $this->assertEquals(0, Cache::get('old-items'));

        /**
         * check for yesterday
         */
        Carbon::setTestNow(Carbon::parse($now)->subDays(1));

        Artisan::call('items:remind');
        $this->assertEquals(0, Cache::get('old-items'));
    }
}
