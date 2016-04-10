<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Zabor\Mysql\User;
use App\Zabor\Mysql\Item;

class ItemPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function manage(User $user, Item $item)
    {
        return $user->pk_i_id === $item->fk_i_user_id;
    }
}
