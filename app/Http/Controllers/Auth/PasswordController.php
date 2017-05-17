<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Zabor\Mysql\User;
use DB;
use Carbon\Carbon;
use Mail;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * [postEmail description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        $user = User::where('s_email', $request->input('email'))->first();

        if ($user == null) {
            return redirect()->back()->withErrors(['email' => 'пользователь не найден']);
        }
        
        DB::table('password_resets')
            ->where('email', $user->s_email)
            ->delete();

        $token = str_random(255);

        DB::table('password_resets')->insert([
            'email' => $user->s_email,
            'token' => $token,
            'created_at' => Carbon::now()
            ]);

        Mail::send('emails.password', compact('token', 'user'), function ($m) use ($user, $token) {
            $m->from('noreply@zabor.kg', 'Служба поддержки Zabor.kg');
            $m->to($user->s_email);
            $m->subject('восстановление пароля');
        });

        return redirect('/')->with('message', [
            'success' => 'письмо с инструкцией по восстановлению пароля отправлено вам на почту'
            ]);
    }


    /**
     * Display the password reset view for the given token.
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function getReset($email, $token = null)
    {
        if (is_null($token)) {
            throw new NotFoundHttpException;
        }

        return view('auth.reset')
                ->with('token', $token)
                ->with('email', $email);
    }

    /**
     * [postReset description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postReset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $reset = DB::table('password_resets')
                    ->where('email', $request->input('email'))
                    ->where('token', $request->input('password'))
                    ->first();

        if ($reset == null) {
            redirect('/')->with('message', [
                'Неверный токен'
                ]);
        }

        $user = User::where('s_email', $request->input('email'))
                        ->first();

        $user->update([
            's_password' => bcrypt($request->input('password'))
            ]);

        return redirect('login')->with('message', [
            'success'   => 'Ваш пароль успешно обновлён'
            ]);
    }
}
