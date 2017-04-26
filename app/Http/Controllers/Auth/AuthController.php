<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\PostRegisterRequest;
use App\Zabor\User\UserManipulator;
use Auth;
use Validator;
use Carbon\Carbon;
use Mail;
use Session;
use URL;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

use App\Zabor\Mysql\UserData;
use App\Zabor\Mysql\User;
use App\Zabor\Mysql\UserDescription;
use App\Zabor\User\UserEloquentRepository;

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

    protected $userRepository;

    /**
     * @var UserManipulator
     */
    private $manipulator;

    /**
     * AuthController constructor.
     * @param UserEloquentRepository $userRepository
     * @param UserManipulator $manipulator
     */
    public function __construct(
        UserEloquentRepository $userRepository,
        UserManipulator $manipulator
    ) {
        $this->userRepository = $userRepository;
        $this->manipulator = $manipulator;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin()
    {
        if (URL::previous() != route('login')) {
            session(['login-origin' => URL::previous()]);
        }

        return view('auth.login');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(Request $request)
    {
        if (Auth::attempt([
                's_email' => $request->input('email'),
                'password' => $request->input('password')
                ])
            ) {
            if (Session::has('login-origin')) {
                $redirect_url = Session::get('login-origin');
                Session::forget('login-origin');
            } else {
                $redirect_url = '/';
            }

                return redirect()->intended($redirect_url);
        }

        return redirect('login')->with(
            'message',
            ['error' => 'Неправильная почта или пароль']
        );
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout()
    {
        Auth::logout();

        return redirect()->intended('/');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRegister()
    {
        return view('auth.register');
    }

    /**
     * @param PostRegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRegister(PostRegisterRequest $request)
    {
        $user = $this->manipulator->createUser($request->all());

        Mail::send('emails.activate', compact('user'), function ($message) use ($user) {
            $message->from('noreply@zabor.kg', 'Служба поддержки Zabor.kg');
            $message->to($user->s_email);
            $message->subject('Регистрация на Zabor.kg');
        });

        return redirect('/')->with('message', [
            'info' => 'Письмо с активацией отправлено вам на почту'
            ]);
    }

    /**
     * @param $email
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reActivate($email)
    {
        $user = $this->userRepository->findByEmail($email);

        if ($user->b_active == 1) {
            return redirect('/')->with('message', [
                'info' => 'учётная запись уже активирована'
            ]);
        }

        if ($user->data->activate_attempts > 2) {
            return redirect('/')->with('message', [
                'error' => 'слишком много попыток активаций, обратитесь к администрации для активации в ручную'
            ]);
        }

        $user->data->increment('activate_attempts');

        Mail::send('emails.activate', compact('user'), function ($message) use ($user) {
            $message->from('noreply@zabor.kg', 'Служба поддержки Zabor.kg');
            $message->to($user->s_email);
            $message->subject('Регистрация на Zabor.kg');
        });

        return redirect('/')->with('message', [
            'info' => 'Письмо с активацией отправлено вам на почту'
        ]);
    }

    /**
     * @param $user_id
     * @param $token
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activateAccount($user_id, $token)
    {
        $user = $this->userRepository->findById($user_id);

        $check = ($token == $user->s_secret);

        if (!$check) {
            return redirect('/')->with('message', [
                'danger' => 'Неверный токен'
                ]);
        }

        if ($check && $user->b_active == 1) {
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
