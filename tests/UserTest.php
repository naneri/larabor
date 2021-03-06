<?php

use App\Zabor\Mysql\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseMigrations, UserTrait;

    /**
     * @test
     */
    public function it_creates_user()
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

    /**
     * @test
     */
    public function it_cant_create_user_with_same_email()
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

    /**
     * @test
     */
    public function it_cant_create_user_with_same_username()
    {
        $this->seed();

        $user = $this->createActivatedUser();

        $this->visit(url('register'))
            ->type($user->s_name, 'username')
            ->type($this->faker->email, 'email')
            ->type('Thegosu88', 'password')
            ->type('Thegosu88', 'password_confirmation')
            ->press('Зарегистрироваться')
            ->seePageIs('register')
            ->see('Такое значение поля логин уже существует');
    }


}
