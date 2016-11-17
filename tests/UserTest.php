<?php

use App\Zabor\Mysql\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    public function test_it_creates_user()
    {
        $this->seed();

        $this->visit(url('register'))
                ->type('kanakana', 'username')
                ->type('ktnaneriaa@gmail.com', 'email')
                ->type('Thegosu88', 'password')
                ->type('Thegosu88', 'pass2')
                ->press('Зарегистрироваться')
                ->seePageIs('/');

        $user = User::where('s_email', 'ktnaneriaa@gmail.com')->first();

        $this->assertEquals('kanakana', $user->s_name);
    }
}
