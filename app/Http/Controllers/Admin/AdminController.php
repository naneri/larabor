<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Zabor\Repositories\Contracts\ItemInterface;
use App\Zabor\Items\ItemManipulator;
use App\Zabor\User\UserEloquentRepository;
use App\Zabor\Repositories\Contracts\CategoryInterface;

class AdminController extends Controller
{
    public $item;
    protected $item_creator;
    protected $user;
    protected $category;

    public function __construct(
        ItemInterface $item,
        CategoryInterface $category,
        ItemManipulator $creator,
        UserEloquentRepository $user
    ) {
        $this->item         = $item;
        $this->category     = $category;
        $this->item_creator = $creator;
        $this->user         = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // active ads posted by custom users in the last 30 days
        $items_posted = $this->item->customLastAdsCount(30);

        // active ads number posted|renewed by custom users
        $item_active = $this->item->activeCustomAdsCount();

        // top sellers info with number of ads posted
        $top_sellers = $this->user->getTopSellers();

        $phone_stat = $this->item->countCategoryCustomActiveItems($this->category->getIdWithChildrenIds(15));

        $pc_stat = $this->item->countCategoryCustomActiveItems($this->category->getIdWithChildrenIds(17));
    
        return view('admin.main', compact(
            'items_posted',
            'item_active',
            'top_sellers',
            'phone_stat',
            'pc_stat'
        ));
    }


}
