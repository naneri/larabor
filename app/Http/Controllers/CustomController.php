<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Mail;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CustomController extends Controller
{

    /**
     * [contacts description]
     * @return [type] [description]
     */
    public function contacts()
    {
        return view('custom.contacts');
    }

    /**
     * [postMessage description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'name'  => 'required|min:3|max:20',
                'email' => 'required|email',
                'message' => 'required|min:10'
            ]);

        $user_email = $request->input('email');

        if($validator->fails()){
            return redirect('contacts')
                ->withErrors($validator)
                ->withInput();
        }

        Mail::send('emails.contact-us', ['data' => $request->all()], function($message) use ($user_email){
            $message->to('support@zabor.kg');
            $message->replyTo($user_email);
            $message->subject('Сообщение от пользователя');
        });

        return redirect('/')->with('message', [
            'success' => 'Ваше сообщение отправлено, постараемся ответить как можно быстрее'
            ]);
    }
}
