<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Hash;
use Str;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function redirectToProvider($provider)
    {
            return Socialite::driver($provider)->redirect();
    }


    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $login = User::firstOrCreate([
            'email' => $user->email
        ],[
            'name'     => $user->nickname,
            'email'    => $user->email,
            'password' => Hash::make(Str::random(24))
        ]);
        if ($login->wasRecentlyCreated) {
            $login->attachRole('user');
            $login->email_verified_at = \Carbon\Carbon::now()->toDateTimeString();
            $login->save();
        }
        Auth::login($login,true);
        return redirect()->route('home');
    }


    public function redirectTo() {
        if(auth()->user()->hasRole(['superadministrator', 'administrator'])) {
            return '/admin/dashboard';
        }
        return '/';
    }
}
