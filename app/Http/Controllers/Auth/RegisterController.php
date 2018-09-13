<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

// sendClound 类
use Naux\Mail\SendCloudTemplate;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/registerSuccess';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'confirmation_token' => str_random(32),
        ]);
        $user->profile()->create([
            'user_id'=> $user->id
        ]);
        $this->sendVerifyEmailTo($user);
        return $user;
    }

    /**
     * 发送邮件给用户
     * @param  array  $user
     * @return void
     */
    private function sendVerifyEmailTo($user)
    {
        $data = [
            'name' => $user->name,
            'url' => route('activation', ['token'=> $user->confirmation_token]),
        ];

        $template = new SendCloudTemplate('activation', $data);

        Mail::raw($template, function ($message) use ($user) {
            $message->from('example@example.com', env('APP_NAME'));
            $message->to($user->email);
        });
    }
}
