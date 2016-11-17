<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Zabor\Mysql\User::class, 30)->create()->each(function ($u) {
            $u->description()->create(['fk_c_locale_code' => 'ru_RU']);
            $u->data()->create([]);
        });

        $user = factory(\App\Zabor\Mysql\User::class)->create([
            's_email'       => 'naneri@rambler.ru',
            's_password'    => bcrypt(104430)
        ]);

        $user->description()->create(['fk_c_locale_code' => 'ru_RU']);
        $user->data()->create([]);
    }
}
