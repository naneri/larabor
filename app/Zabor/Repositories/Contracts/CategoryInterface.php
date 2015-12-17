<?php namespace App\Zabor\Repositories\Contracts;

interface CategoryInterface
{
	public function getRootCategories();

	public function getIdWithChildrenIds($category_id);

	public function getAncestors($category_id);
}