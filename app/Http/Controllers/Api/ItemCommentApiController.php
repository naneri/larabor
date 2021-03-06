<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CommentRequest;
use App\Zabor\Items\CommentService;
use App\Zabor\Mysql\ItemComment;
use App\Zabor\Items\ItemEloquentRepository;
use Auth;
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
     * @var CommentService
     */
    private $commentService;

    /**
     * ItemCommentApiController constructor.
     * @param ItemEloquentRepository $itemRepository
     * @param CommentService $commentService
     */
    public function __construct(
        ItemEloquentRepository $itemRepository,
        CommentService $commentService
    ) {
        $this->itemRepository = $itemRepository;
        $this->commentService = $commentService;
    }

    /**
     * @param $item_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getComments($item_id)
    {
        $comments = ItemComment::with('user')->where('item_id', $item_id)
            ->orderBy('created_at', 'DESC')
            ->paginate(5);

        return response()->json($comments);
    }

    /**
     * @param CommentRequest $request
     * @param $item_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function postComment(CommentRequest $request, $item_id)
    {
        echo 11;
        $comment = ItemComment::create([
            'item_id' => $item_id,
            'user_id' => Auth::id(),
            'text'    => $request->input('text')
        ]);

        if(Auth::id()){

            $this->commentService->checkAndNotify($comment, Auth::user());
        }

        return response()->json(['result' => 'Ваш комментарий успешно опубликован']);
    }
}
