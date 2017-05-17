<?php

use App\Zabor\Mysql\Archive;
use App\Zabor\Mysql\Item;
use App\Zabor\Mysql\ItemDescription;
use App\Zabor\Items\ItemEloquentRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Zabor\Items\ItemManipulator;

class ItemTest extends TestCase
{
    use DatabaseMigrations;

    protected $manipulator;
    protected $repository;

    public function setUp()
    {
        parent::setUp();
        $this->manipulator  = App::make(ItemManipulator::class);
        $this->repository   = App::make(ItemEloquentRepository::class);
    }

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

        $item = $this->manipulator->store($item_data, null, 30);

        $this->assertEquals($item_data['seller-email'], $item->s_contact_email);
    }

    /**
     * @test
     */
    public function it_can_delete_items()
    {
        $this->seed();
        $item = factory(Item::class)->create();

        $this->manipulator->delete($item);

        $item = Item::find($item->pk_i_id);

        $this->assertNull($item);
    }

    /**
     * @test
     */
    function it_can_manage_ads_with_code()
    {
        $this->seed();
        $item = factory(Item::class)->create();

        $item->description()->save(factory(ItemDescription::class)->make());

        $itemUrl = route('item.show', [$item->pk_i_id, $item->s_secret]);
        $this->visit($itemUrl)
                ->see('Редактировать')
                ->click('Продлить')
                ->seePageIs($itemUrl)
                ->see("toastr.error");
    }

    /**
     * @test
     */
    function it_can_prolong_items()
    {
        $this->seed();
        $item = factory(Item::class)->create([
            'dt_pub_date'       => Carbon::now()->subDays(3),
            'dt_update_date'    => Carbon::now()->subDays(3),
        ]);

        // ot sees the control buttons with code and can use them
        $item->description()->save(factory(ItemDescription::class)->make());

        $itemUrl = route('item.show', [$item->pk_i_id, $item->s_secret]);
        $this->visit($itemUrl)
            ->see('Редактировать')
            ->click('Продлить')
            ->seePageIs($itemUrl)
            ->see("toastr.success");


        // it does not see control buttons without code and cant use them
        $itemUrl = route('item.show', [$item->pk_i_id]);

        $this->visit($itemUrl)
            ->dontSee('Редактировать');
    }

    /**
     * @test
     */
    public function itExpiresItem()
    {
        $this->seed();
        $item = factory(Item::class)->create([
            'dt_pub_date'       => Carbon::now()->subDays(3),
            'dt_update_date'    => Carbon::now()->subDays(3),
        ]);

        // ot sees the control buttons with code and can use them
        $item->description()->save(factory(ItemDescription::class)->make());

        $this->visit(route('item.show', [$item->pk_i_id]))
           ->see($item->description->s_title);

        $item->update(['dt_expiration' => Carbon::now()->subDays(200)]);

        Archive::create([
            'entity_id' => $item->pk_i_id,
            'type'      => 'item',
            'content'   => $item->toJson()
        ]);

        $this->manipulator->delete($item);

        $this->get(route('item.show', [$item->pk_i_id]))
                ->assertResponseStatus(410);
    }
}
