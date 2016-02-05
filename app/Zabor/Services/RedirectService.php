<?php namespace App\Zabor\Services;

class RedirectService{

	/**
	 * [redirect description]
	 * @param  [type] $params [description]
	 * @return [type]         [description]
	 */
	public function redirect($params)
	{
		if($params['page'] == 'item' && isset($params['id'])){
			return str_replace('/index.php', '', route('item.show', $params['id']));
		}

	
		return '/';
	}

}