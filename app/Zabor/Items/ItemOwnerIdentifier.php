<?php namespace App\Zabor\Items;


class ItemOwnerIdentifier
{

    /**
     * @param $item_owner_id
     * @param $item_secret
     * @param $user
     * @param $code
     * @return bool
     */
    public function checkOwnership($item_owner_id, $item_secret, $user, $code)
    {
        if (!is_null($user)) {
            if ($user->pk_i_id == $item_owner_id) {
                return true;
            }
        }
        if (!is_null($code)) {
            if ($code == $item_secret) {
                return true;
            }
        }
        return false;
    }
}
