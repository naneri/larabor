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
    public function itemCommentTest()
    {
        $user = User::first();
        $user2 = User::skip(1)->first();
        $item = factory(Item::class)->create(['fk_i_user_id' => $user->pk_i_id]);
        $comment = factory(ItemComment::class)->create(['item_id' => $item->pk_i_id, 'user_id' => $user2->pk_i_id]);
        $comment2 = factory(ItemComment::class)->create(['item_id' => $item->pk_i_id, 'user_id' => $user->pk_i_id]);

        $commentService = app(CommentService::class);

        $this->assertTrue($commentService->checkAndNotify($comment, $user2));
        $this->assertFalse($commentService->checkAndNotify($comment2, $user));

        $userData =  UserData::firstOrCreate(['fk_i_user_id'  => $user->pk_i_id]);

        $userData->comment_notification = false;
        $userData->save();

        $this->assertFalse($commentService->checkAndNotify($comment, $user));
    }

}
