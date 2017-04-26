<?php

use App\Zabor\Items\ItemManipulator;
use App\Zabor\Repositories\ItemEloquentRepository;
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
    public function mainPageTest()
    {
        $this->visit('/')
            ->assertResponseOk();
    }

}
