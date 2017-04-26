<?php namespace App\Zabor\Services;

class RedirectService
{

    /**
     * @param $params
     *
     * @return mixed|string
     */
    public function redirect($params)
    {
        if ($params['page'] == 'item' && isset($params['id'])) {
            return str_replace('/index.php', '', route('item.show', $params['id']));
        }

        return '/';
    }
}
