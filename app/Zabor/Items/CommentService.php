<?php
/**
 * Date: 28.04.2017
 * Time: 11:51
 */

namespace App\Zabor\Items;


use App\Zabor\Mysql\Item;
use App\Zabor\Mysql\UserData;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Mail;

class CommentService
{

    /**
     * @param $item
     * @param $comment
     * @param $user
     * @return bool
     */
    public function checkAndNotify($item, $comment, $user)
    {
        if($item->fk_i_user_id != $user->pk_i_id){

            $userData = UserData::find($user->pk_i_id);

            if($userData != null){
                if(!$userData->comment_notification){

                }else{
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
        }

        return false;
    }
}