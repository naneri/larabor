<?php namespace App\Zabor\Categories\Contracts;

interface CategoryInterface
{
    public function getRootCategories();

    public function getIdWithChildrenIds($category_id);

    public function getAncestors($category_id);
}
