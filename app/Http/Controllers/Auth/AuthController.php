<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Zabor\Mysql\User;
use Validator;
use Carbon\Carbon;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * [postLogin description]
     * 
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postLogin(Request $request)
    {
        if (Auth::attempt(['s_email' => $request->input('email'), 'password' => $request->input('password')])) {
            return redirect()->intended('/');
        }

        return redirect('login')->with(
            'errors',
            ['Неправильная почта или пароль']
        );
    }

    /**
     * Logs out the user
     * @return [type] [description]
     */
    public function getLogout()
    {
        Auth::logout();

        return redirect()->intended('/');;
    }

    /**
     * [postRegister description]
     * 
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'  => 'required|alpha_num|min:3|max:30',
            'email'     => 'required|email|unique:user,s_email',
            'password'  => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect('register')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = User::create([
            'dt_reg_date'   => Carbon::now(),
            's_name'        => $request->input('username'),
            's_password'    => bcrypt($request->input('password')),
            's_secret'      => str_random(8),
            's_email'       => $request->input('email'),
            'b_enabled'     => 1,
            'b_active'      => 0,
            'i_items'       => 0,
            'i_comments'    => 0,
            'dt_access_date'=> Carbon::now()
            ]);

        Mail::send('email.activate-account', compact('user'), function($message) use ($user){
            $message->to($user->s_email);
            $message->subject('Регистрация на Zabor.kg');
        });


        return redirect('/')->with('message', [
            'info' => 'Письмо с активацией отправлено вам на почту'
            ]);
    }

    /**
     * [ActivateAccount description]
     * 
     * @param [type] $user_id [description]
     * @param [type] $token   [description]
     */
    public function ActivateAccount($user_id, $token)
    {
        $user = User::find($user_id);

        $check = $token == $user->s_secret;

        if(!$check){
            return redirect('/')->with('message', [
                'danger' => 'Неверный токен'
                ]);
        }

        if($check && $user->b_active == 1){
            return redirect('/login')->with('message', [
                'info' => 'Пользователь уже активирован'
                ]);
        }

        $user->update(['b_active' => 1]);

        Auth::login($user);

        return redirect('/')->with('message', [
                'success' => 'Активация прошла успешно'
                ]);

    }
}