<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Zabor\Repositories\Contracts\ItemInterface;
use App\Zabor\Items\ItemManipulator;
use App\Zabor\User\UserEloquentRepository;

class AdminController extends Controller
{
    public $item;
    protected $item_creator;
    protected $user;

    public function __construct(ItemInterface $item,
                                ItemManipulator $creator,
                                UserEloquentRepository $user)
    {
        $this->item = $item;
        $this->item_creator = $creator;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items_posted = $this->item->customLastAdsCount(30);

        $item_active = $this->item->activeCustomAdsCount();

        $top_sellers = $this->user->getTopSellers();

        return view('admin.main', compact('items_posted', 'item_active', 'top_sellers'));
    }

    /**
     * [inactiveItems description]
     * @return [type] [description]
     */
    public function inactiveItems(Request $request)
    {
        return view('admin.inactive-items');
    }

    public function getInactiveItems()
    {
        return $this->item->getCustomInactiveItems();
    }

    /**
     * [deleteItem description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function deleteItem(Request $request, $id)
    {
        $item_id = $id;

        $item = $this->item->getById($item_id);

        $this->item_creator->delete($item);

        return response()->json(['success' => true]);
    }

    /**
     * [activateItem description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function activateItem(Request $request, $id)
    {
        $item = $this->item_creator->activate($id);

        \Mail::send('emails.item.activated', compact('item'), function ($message) use ($item){
                $message->to($item->s_contact_email)->subject('Ваше объявление было активировано!');
        });
        return response()->json(['success' => true]);
    }

    /**
     * [blockItem description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function blockItem(Request $request, $id)
    {
        if($this->item_creator->block($id)){
            
            $item = $this->item->getById($id);

            return response()->json(['success' => true, 'item'  => $item]);
        }

        return response()->json(['success' => false]);
    }


    /**
     * [userItems description]
     * @return [type] [description]
     */
    public function userItems()
    {
        return view('admin.user-items');
    }

    /**
     * [getUserItems description]
     * @return [type] [description]
     */
    public function getUserItems()
    {
        $items = $this->item->getCustomItems();

        return $items;
    }
}
