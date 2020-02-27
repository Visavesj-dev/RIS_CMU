<?php

namespace App\Http\Controllers;

use Socialite;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

class AuthController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        if (App::environment(['local', 'dev'])) {
            return redirect()->route('login-as-dev');
        }

        return Socialite::driver('cmu')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $cmuAccount = Socialite::driver('cmu')->user();

        $user = User::where('email', $cmuAccount->cmu_it_account)->first();

        if (!$user) {
            return redirect()->route('login');
        }

        $user->name = $cmuAccount->prename_TH . $cmuAccount->firstname_TH . ' ' . $cmuAccount->lastname_TH;
        $user->save();

        Auth::login($user);

        return redirect()->route('home');
    }

    public function anonymousLogin()
    {
        if (!App::environment(['local', 'dev'])) {
            return redirect()->route('login');
        }

        $user = User::firstOrCreate(['email' => 'dev@cmu.ac.th']);
        $user->name = 'Jarb TheDev';
        $user->save();

        Auth::login($user);

        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
