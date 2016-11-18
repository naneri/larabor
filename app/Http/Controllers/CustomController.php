<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;

use Validator;
use Mail;
use App\Http\Requests;

class CustomController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contacts()
    {
        return view('custom.contacts');
    }

    /**
     * @param ContactRequest $request
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postMessage(ContactRequest $request)
    {
        $user_email = $request->input('email');

        Mail::send('emails.contact-us', ['data' => $request->all()], function ($message) use ($user_email) {
            $message->to('support@zabor.kg');
            $message->replyTo($user_email);
            $message->subject('Сообщение от пользователя');
        });

        return redirect('/')->with('message', [
            'success' => 'Ваше сообщение отправлено, постараемся ответить как можно быстрее'
            ]);
    }
}
