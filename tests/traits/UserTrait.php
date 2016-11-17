<?php

/**
 * Date: 17.11.2016
 * Time: 23:20
 */
trait UserTrait
{
    /**
     * @param $data
     * @return mixed
     */
    public function createActivatedUser($data = [])
    {
        $user = factory(\App\Zabor\Mysql\User::class)->create($data);

        $user->description()->create(['fk_c_locale_code' => 'ru_RU']);

        $user->data()->create([]);

        return $user;
    }
}