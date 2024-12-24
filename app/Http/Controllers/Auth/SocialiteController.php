<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $socialUser = Socialite::driver('google')->user();

        $registeredUser = User::where('google_id', $socialUser->id)->first();

        if (!$registeredUser) {
            $user = User::updateOrCreate([
                'google_id' => $socialUser->id,
            ], [
                'id_user' => 'U' . str_pad(intval(substr(User::max('id_user'), 1)) + 1, 3, '0', STR_PAD_LEFT),
                'name' => $socialUser->name ?? 'Guest',
                'email' => $socialUser->email,
                'username' => strtolower(str_replace(' ', '_', $socialUser->name)),
                'password' => Hash::make(123),
                'google_token' => $socialUser->token,
                'google_refresh_token' => $socialUser->refreshToken,
            ]);

            Auth::guard('web')->login($user);

            Log::info('New user logged in:', $user->toArray());

            return redirect('/dashboard');
        }

        Auth::guard('web')->login($registeredUser);

        Log::info('Existing user logged in:', $registeredUser->toArray());

        return redirect('/dashboard');
    }
}
