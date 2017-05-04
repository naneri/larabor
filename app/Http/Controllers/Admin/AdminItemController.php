<?php

namespace App\Http\Controllers\Admin;

use App\Zabor\Items\ItemManipulator;
use App\Zabor\Mysql\ItemComment;
use App\Zabor\Repositories\Contracts\CategoryInterface;
use App\Zabor\Repositories\Contracts\ItemInterface;
use App\Zabor\User\UserEloquentRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminItemController extends Controller
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
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function inactiveItems(Request $request)
    {
        return view('admin.inactive-items');
    }

    /**
     * @return mixed
     */
    public function getInactiveItems()
    {
        return $this->item->getCustomInactiveItems();
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteItem(Request $request, $id)
    {
        $item_id = $id;

        $item = $this->item->getById($item_id);

        $this->item_creator->delete($item);

        return response()->json(['success' => true]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function activateItem(Request $request, $id)
    {
        $item = $this->item_creator->activate($id);

        \Mail::send('emails.item.activated', compact('item'), function ($message) use ($item) {
            $message->to($item->s_contact_email)->subject('Ваше объявление было активировано!');
        });
        return response()->json(['success' => true]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function blockItem(Request $request, $id)
    {
        if ($this->item_creator->block($id)) {
            $item = $this->item->getById($id);

            return response()->json(['success' => true, 'item'  => $item]);
        }

        return response()->json(['success' => false]);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userItems()
    {
        return view('admin.user-items');
    }

    /**
     * @return mixed
     */
    public function getUserItems()
    {
        $items = $this->item->getCustomItems();

        return $items;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function comments()
    {
        $comments = ItemComment::with(['user', 'item'])->orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.comments', compact('comments'));
    }
}
