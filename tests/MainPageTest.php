<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MainPageTest extends TestCase
{
    use DatabaseMigrations;

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


}
