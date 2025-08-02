<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CompleteRegisterController extends Controller
{
    private $rules = [
        'username' => 'required|string|max:255|unique:users,username',
        'company_id' => 'required|integer|exists:companies,id',
        'password' => 'required|string|min:8|confirmed',
    ];
    
    public function index()
    {
        if (!session()->has('social_user')) {
            return redirect()->route('login')->with('error', 'Session expired');
        }
        return view('components.auth.complete-register');
    }

    public function store(Request $request)
    {

        $session_user = session('social_user');

        if (!$session_user) {
            return redirect()->route('login')->with('error', 'Session expired');
        }
        $request->validate($this->rules);


        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $session_user['name'],
                'email' => $session_user['email'],
                'password' => Hash::make($request->password),
                'username' => $request->username,
                'company_id' => $request->company_id,
                'provider_id' => $session_user['provider_id'],
                'provider' => $session_user['provider'],
                'provider_token' => $session_user['provider_token'],
            ]);

            Auth::login($user, true);
            DB::commit();
            session()->forget('social_user');
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
