<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MainPageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->visit('/')
        	->see('объявление');

        $this->visit('/')
         ->click('Контакты')
         ->seePageIs('/contacts');

    }

    /**
     * @test 
     */
    public function it_can_login()
    {
        $this->visit('/login')
            ->assertResponseOk();
    }

    /**
     * @test 
     */
    public function it_does_redirect_from_old_item_show()
    {
        $this->visit('/index.php?page=item&id=86497')
            ->seePageIs('/item/show/86497');
    }

    /**
     * @test 
     */
    public function it_removes_index_php()
    {
        $this->visit('/index.php')
            ->seePageIs('/');
    }
}
