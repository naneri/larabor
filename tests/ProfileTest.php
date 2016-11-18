<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class ProfileTest extends TestCase
{
    use DatabaseMigrations, UserTrait;

    /**
     * @test
     */
    public function it_can_change_password()
    {
        $this->seed();
        $pass       = str_random(8);
        $new_pass   = str_random(8);
        $user       = $this->createActivatedUser(['s_password'    => bcrypt($pass), 'is_admin'  => null]);

        $this->actingAs($user)
                ->visit('profile/main')
                ->type($pass, 'password')
                ->type($new_pass, 'new_password')
                ->type($new_pass, 'new_password_confirmation')
                ->press('Обновить')
                ->seePageIs('profile/main')
                ->see('toastr.success');
    }
}
