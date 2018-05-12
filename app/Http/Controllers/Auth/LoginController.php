<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Laravel\Socialite\Facades\Socialite;
use Mockery\Exception;

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


    public function logout()
    {
        Auth::logout();
        return redirect()->to('/');
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(Request $request)
    {
        if (!$request->has('code') || $request->has('denied')) {
            return redirect('/');
        }
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (Exception $ex){
            // message here
            return redirect('/login');
        }

        if (!$user) {
            return redirect('/');
        }
        $user_if_exist = User::where('email', $user->email)->first();
        try {
            if (!$user_if_exist) {
                $user = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => bcrypt(now()),
                    'image' => $user->avatar,
                    'username' => $user->email,
                    'social_id' => $user->token,
                ]);
                Auth::login($user);
            } else {
                $user_if_exist->update([
                    'email' => $user->email,
                ]);
                Auth::login($user_if_exist);
            }
        } catch (\Exception $ex) {
            // message here
            return redirect('/login');
        }

        return redirect('/');
    }


    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        if (!$request->has('code') || $request->has('denied')) {
            return redirect('/');
        }
        $user = Socialite::driver('google')->user();

        if (!$user) {
            return redirect('/');
        }
        $user_if_exist = User::where('email', $user->email)->first();
        try {
            if (!$user_if_exist) {
                $user = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => bcrypt(now()),
                    'image' => $user->avatar,
                    'username' => $user->email,
                    'social_id' => $user->token,
                ]);
                Auth::login($user);
            } else {
                $user_if_exist->update([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => bcrypt(now()),
                    'image' => $user->avatar,
                    'username' => $user->email,
                    'social_id' => $user->token,
                ]);
                Auth::login($user_if_exist);
            }
        } catch (\Exception $ex) {
            return redirect('/login');
        }

        return redirect('/');
    }
}
