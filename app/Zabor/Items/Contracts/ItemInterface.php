<?php namespace App\Zabor\Items\Contracts;

interface ItemInterface
{
    public function getLast();

    public function getById($id);

    public function countActive();

    public function searchItems($data, $category_id_list);

    public function countCategoryCustomActiveItems($cat_ids_array);

    public function getUserActiveAds($user_id, $limit = null);

    public function getUserAdsForExport($user_id);

    public static function getOldItems();

    public function getCustomInactiveItems();

    public function getCustomItems();
}
