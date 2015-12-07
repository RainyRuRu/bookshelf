<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
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

    protected $redirectPath = '/';

    protected $loginPath = '/auth/login';

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
        $rules = [
            'username' => 'required|alpha_dash|max:255|unique:users',
            'email'    => 'email|max:255',
            'password' => 'required|confirmed|min:6',
        ];

        $messages = [
            'required' => '請輸入帳號與密碼',
            'unique' => '您所輸入的帳號已經有人申請',
        ];

        return Validator::make($data, $rules, $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $data['email'] = $data['username'] . '@kkbox.com';

        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }


    public function postLogin(Request $request)
    {
        $rules = [
            'username' => 'required', 
            'password' => 'required',
        ];

        $messages = [
            'required' => $this->getFailedLoginMessage(),
        ];

        $this->validate($request, $rules, $messages);

        $username = $request->input('username');
        $password = $request->input('password');

    
        if (\Auth::attempt(['username' => $username, 'password' => $password])) {
            return redirect()->intended($this->redirectPath);
        } else {
           return redirect($this->loginPath())
                ->withInput($request->only($this->loginUsername(), 'remember'))
                ->withErrors([
                    $this->loginUsername() => $this->getFailedLoginMessage(),
                ]);
        }

    }

    public function getFailedLoginMessage(){
        return '登入失敗，帳號或密碼錯誤';
    }

}