<?php
/**
 * Date: 28.04.2017
 * Time: 11:51
 */

namespace App\Zabor\Items;


use App\Events\CommentNotify;
use App\Zabor\Mysql\UserData;
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

            event(new CommentNotify());
            $userData =  UserData::firstOrCreate(['fk_i_user_id'  => $user->pk_i_id]);

            $itemTitle = str_limit($item->description->s_title, 30);
            if($userData->comment_notification){
                try{
                    $email = !empty($item->user) ? $item->user->s_email: $item->s_contact_email;
                    Mail::send('emails.comment', compact('comment', 'user', 'item'), function ($m) use ($comment, $user, $item, $itemTitle, $email) {
                        $m->from('noreply@zabor.kg', 'Служба поддержки Zabor.kg');
                        $m->to($email, $user->s_name)->subject("К вашему обьявлению {$itemTitle} оставлен комментарий ");
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