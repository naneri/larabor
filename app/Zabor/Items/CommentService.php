<?php
/**
 * Date: 28.04.2017
 * Time: 11:51
 */

namespace App\Zabor\Items;


use App\Zabor\Mysql\Item;
use App\Zabor\Mysql\UserData;
use App\Zabor\Repositories\ItemEloquentRepository;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Mail;

class CommentService
{
    /**
     * @var ItemEloquentRepository
     */
    private $itemEloquentRepository;

    /**
     * CommentService constructor.
     * @param ItemEloquentRepository $itemEloquentRepository
     */
    public function __construct(ItemEloquentRepository $itemEloquentRepository)
    {
        $this->itemEloquentRepository = $itemEloquentRepository;
    }
    /**
     * @param $comment
     * @param $user
     * @return bool
     */
    public function checkAndNotify($comment, $user)
    {
        $item = $this->itemEloquentRepository->getById($comment->item_id);

        if($item->fk_i_user_id != $user->pk_i_id){

            $userData =  UserData::firstOrCreate(['fk_i_user_id'  => $user->pk_i_id]);

            if($userData->comment_notification){
                try{
                    Mail::send('emails.comment', compact('comment', 'user'), function ($m) use ($comment, $user) {
                        $m->from('noreply@zabor.kg', 'Служба поддержки Zabor.kg');
                        $m->to($user->s_email, $user->s_name)->subject("К вашему обьявлению оставлен комментарий ");
                    });
                }catch (\Exception $e){
                    Bugsnag::notifyException($e);
                }
                return true;
            }
        }

        return false;
    }
}