<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Zabor\Items\ItemManipulator;

class ItemTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    /**
     * @test
     */
    public function it_can_create_items()
    {
        $item_data = [
            'title' => 'kana laptop',
            'description'   => 'anasdasto',
            'price'     => 150,
            'currency'  => 'USD',
            "seller-email" => "ktneri@gmail.com",
            'image_key' => str_random(10),
            'meta'  => [
                1 => "+996555926924",
                3 => "Новый",
                6 => "Продам",
                7 => "+996555926924",
            ],
            'category'  => '99'
        ];

        $manipulator = App::make(ItemManipulator::class);

        $item = $manipulator->store($item_data, null, 30);

        $this->assertEquals($item_data['seller-email'], $item->s_contact_email);
    }

    public function it_can_create_items2()
    {
        $this->call('POST', '/item/add', ['name' => 'Taylor']);
    }
}
