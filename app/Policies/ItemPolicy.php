<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Zabor\Mysql\User;
use App\Zabor\Mysql\Item;

class ItemPolicy
{
    use HandlesAuthorization;

    /**
     * [before description]
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function before(User $user)
    {
        if ($user->is_admin()) {
            return true;
        }
    }

    /**
     * [manage description]
     * @param  User   $user [description]
     * @param  Item   $item [description]
     * @param  [type] $code [description]
     * @return [type]       [description]
     */
    public function manage(User $user, Item $item, $code = null)
    {
        if ($user->pk_i_id === $item->fk_i_user_id) {
            return true;
        }
        if (!is_null($code)) {
            if ($item->s_secret == $code) {
                return true;
            }
        }

        return false;
    }
}
