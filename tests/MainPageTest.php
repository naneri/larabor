<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MainPageTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function main_page()
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
    function it_can_send_contacts_email()
    {
        $name = str_random(6);
        $email = 'naneri@maila.ru';

        $this->visit('contacts')
                ->type($name, 'name')
                ->type($email, 'email')
                ->press('Отправить')
                ->seePageIs('contacts')
                ->see('Поле сообщение обязательно для заполнения')
                ->see($name)
                ->see($email)
                ->type(str_random(16), 'message')
                ->press('Отправить')
                ->seePageIs('/')
                ->see('toastr.success');
    }
}
