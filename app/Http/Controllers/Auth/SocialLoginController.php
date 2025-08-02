<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect($providers)
    {
        return Socialite::driver($providers)->redirect();
    }

    public function callback($providers){
        $user_provider = Socialite::driver($providers)->stateless()->user();
        
        $user = User::where('provider_id', $user_provider->id)
        ->where('provider', $providers)
        ->where('email', $user_provider->email)
        ->first();

        if($user){
            Auth::login($user);
            return redirect()->route('dashboard');
        }

        session([
            'social_user' => [
                'name' => $user_provider->name,
                'email' => $user_provider->email,
                'provider_id' => $user_provider->id,
                'provider' => $providers,
                'provider_token' => $user_provider->token,
            ]
        ]);

        return redirect()->route('complete.register');
    }
    
}
