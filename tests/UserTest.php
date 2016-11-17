<?php

use App\Zabor\Mysql\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseMigrations, UserTrait;

    public function test_it_creates_user()
    {
        $this->seed();

        $this->visit(url('register'))
                ->type('kanakana', 'username')
                ->type('ktnaneriaa@gmail.com', 'email')
                ->type('Thegosu88', 'password')
                ->type('Thegosu88', 'password_confirmation')
                ->press('Зарегистрироваться')
                ->seePageIs('/');

        $user = User::where('s_email', 'ktnaneriaa@gmail.com')->first();

        $this->assertEquals('kanakana', $user->s_name);
    }

    public function test_it_cant_create_user_with_same_name()
    {
        $this->seed();

        $user = $this->createActivatedUser();

        $this->visit(url('register'))
            ->type('kanakana', 'username')
            ->type($user->s_email, 'email')
            ->type('Thegosu88', 'password')
            ->type('Thegosu88', 'password_confirmation')
            ->press('Зарегистрироваться')
            ->seePageIs('register')
            ->see('Такое значение поля email уже существует');
    }
}
