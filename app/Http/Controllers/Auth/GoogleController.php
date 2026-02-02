<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        $email = $googleUser->getEmail();
        $name  = $googleUser->getName();
        $googleId = $googleUser->getId();

        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'nama' => $googleUser->getName(),
                'username' => Str::before($googleUser->getEmail(), '@'),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt(Str::random(16)),
            ]);
        }

        Auth::login($user);

        if ($user->role === 'admin') {
            return redirect()->route('jenis-layanan.index'); // dashboard admin
        }
        return redirect()->route('transaksi.index');
    }
}
