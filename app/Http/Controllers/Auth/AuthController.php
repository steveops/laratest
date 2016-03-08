<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
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
     * @param  array $data
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

    public function redirectToGihub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function gituser()
    {
        try {
            $gitUser = Socialite::driver('github')->user();
        } catch (\Exception $e) {
            return redirect('auth/github');
        }

        Auth::login($this->findOrCreateFromGit($gitUser), true);

        return redirect('home');
    }

    public function findOrCreateFromGit($user)
    {
        $authUser = User::where('github_id', $user->id)->first();

        return !is_null($authUser) ? $authUser : User::create(
            [
                'email' => $user->email,
                'github_id' => $user->id,
                'nickname' => $user->nickname,
                'avatar_url' => $user->user['avatar_url'],
                'html_url' => $user->user['html_url'],
                'name' => $user->name,
            ]
        );
    }
}
