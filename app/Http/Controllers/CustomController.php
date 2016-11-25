<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Zabor\Notifier;
use Illuminate\Http\Request;

use Validator;
use Mail;
use App\Http\Requests;

class CustomController extends Controller
{
    /**
     * @var Notifier
     */
    private $notifier;

    /**
     * CustomController constructor.
     * @param Notifier $notifier
     */
    public function __construct(Notifier $notifier)
    {
        $this->notifier = $notifier;
    }
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

        $message = sprintf('<b>New message from %s, text:</b> <i>%s</i>', $request->get('email'), htmlentities($request->get('message')));

        $this->notifier->notify($message);

        return redirect('/')->with('message', [
            'success' => 'Ваше сообщение отправлено, постараемся ответить как можно быстрее'
            ]);
    }
}
