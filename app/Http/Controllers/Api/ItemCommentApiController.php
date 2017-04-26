<?php

namespace App\Http\Controllers\Api;

use App\Zabor\Mysql\ItemComment;
use App\Zabor\Repositories\ItemEloquentRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ItemCommentApiController extends Controller
{

    /**
     * @var ItemEloquentRepository
     */
    private $itemRepository;

    /**
     * ItemCommentApiController constructor.
     * @param ItemEloquentRepository $itemRepository
     */
    public function __construct(ItemEloquentRepository $itemRepository) {
        $this->itemRepository = $itemRepository;
    }

    /**
     * @param $item_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getComments($item_id)
    {
        $comments = ItemComment::with('user')->where('item_id', $item_id)->get();

        return response()->json($comments);
    }
}
