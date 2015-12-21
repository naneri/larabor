<?php namespace App\Zabor\Repositories\Contracts;

interface ItemInterface
{
	public function getLast();

	public function getById($id);

	public function countActive();

	public function store($item_data, $user, $days);

	public function searchItems($data, $category_id_list);
	
}