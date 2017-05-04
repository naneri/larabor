<?php

use App\Zabor\Mysql\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @test
     */
    function it_can_visit_all_routes()
    {
        $this->seed();

        $user = User::where('is_admin', true)->first();

        $this->actingAs($user)
            ->visit(url('admin/item/get-inactive-items'))
            ->assertResponseOk()
            ->visit(url('admin/items/non-affiliate'))
            ->assertResponseOk()
            ->visit(url('admin/items/comments'))
            ->assertResponseOk();
    }
}
