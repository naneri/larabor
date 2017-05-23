<?php

use App\Zabor\Items\CommentService;
use App\Zabor\Items\ItemManipulator;
use App\Zabor\Mysql\Item;
use App\Zabor\Mysql\ItemComment;
use App\Zabor\Mysql\User;
use App\Zabor\Mysql\UserData;
use App\Zabor\Items\ItemEloquentRepository;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Zabor\Mysql\ItemDescription;

class ItemApiTest extends TestCase
{

    use DatabaseMigrations;
    use UserTrait;

    protected $manipulator;
    protected $repository;
    protected $user;

    public function setUp()
    {
        parent::setUp();
        $this->seed();
        $this->manipulator  = App::make(ItemManipulator::class);
        $this->repository   = App::make(ItemEloquentRepository::class);
        $this->user         = $this->createActivatedUser();
    }

    /**
     * @test
     */
    public function it_notifies_if_other_user_replies()
    {
        $user = User::first();
        $user2 = User::skip(1)->first();
        $item = factory(Item::class)->create(['fk_i_user_id' => $user->pk_i_id]);
        factory(ItemDescription::class)->create(['fk_i_item_id' => $item->pk_i_id]);

        $this->expectsEvents(App\Events\CommentNotify::class);

        $this->actingAs($user2)->post(route('api.item.comments.post', ['item_id' => $item->pk_i_id]), [
            'text' => $this->faker->text()
        ]);
    }

    /**
     * @test
     */
    function it_does_not_notify_if_you_comment_your_own_item()
    {
        $user = User::first();
        $item = factory(Item::class)->create(['fk_i_user_id' => $user->pk_i_id]);
        factory(ItemDescription::class)->create(['fk_i_item_id' => $item->pk_i_id]);

        $this->doesntExpectEvents(App\Events\CommentNotify::class);

        $this->actingAs($user)->post(route('api.item.comments.post', ['item_id' => $item->pk_i_id]), [
            'text' => $this->faker->text()
        ]);
    }

    /**
     * @test
     */
    function it_notifies_for_anonymous_users()
    {
        $user = User::first();
        $item = factory(Item::class)->create();
        factory(ItemDescription::class)->create(['fk_i_item_id' => $item->pk_i_id]);

        $this->expectsEvents(App\Events\CommentNotify::class);

        $this->actingAs($user)->post(route('api.item.comments.post', ['item_id' => $item->pk_i_id]), [
            'text' => $this->faker->text()
        ]);
    }

    /**
     * @test
     */
    function it_does_not_notify_if_anonymous_user_replies_to_himself()
    {
        $item = factory(Item::class)->create();
        factory(ItemDescription::class)->create(['fk_i_item_id' => $item->pk_i_id]);

        $this->doesntExpectEvents(App\Events\CommentNotify::class);

        $this->post(route('api.item.comments.post', ['item_id' => $item->pk_i_id]), [
            'text' => $this->faker->text()
        ]);
    }

}
