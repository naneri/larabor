<?php
/**
 * Date: 28.04.2017
 * Time: 11:51
 */

namespace App\Zabor\Items;


use App\Zabor\Mysql\UserData;
use Mail;

class CommentService
{

    /**
     * @param $comment
     * @param $user
     *
     * @return bool
     */
    public function checkAndNotify($comment, $user)
    {
        if($comment->user_id != $user->pk_i_id){
            $userData = UserData::find($user->pk_i_id);
            if($userData->comment_notification){
                try{
                    Mail::send('emails.comment', compact('comment', 'user'), function ($m) use ($comment, $user) {
                        $m->from('noreply@zabor.kg', 'Служба поддержки Zabor.kg');
                        $m->to($user->email, $user->name)->subject("К вашему обьявлению оставлен комментарий ");
                    });
                }catch (\Exception $e){

                }
                return true;
            }
        }

        return false;
    }
}