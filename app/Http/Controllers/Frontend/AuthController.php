<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showSignInForm(): View
    {
        return view("frontend.auth.signin_form");
    }

    public function signIn(SignInRequest $request): RedirectResponse
    {
        try {
            $credentials = $request->only(['email', 'password']);
            $remember = $request->has('remember-me');

            if (Auth::attempt($credentials, $remember)) {
                $request->session()->regenerate();
                return redirect()->intended('/')->with('success', 'Başarıyla giriş yaptınız.');
            }

            return back()->withErrors([
                'email' => 'Girdiğiniz bilgiler hatalı.',
            ])->onlyInput('email');

        } catch (\Exception $e) {
            return back()->with('error', 'Giriş yapılırken bir hata oluştu.');
        }
    }

    public function showSignUpForm(): View
    {
        return view("frontend.auth.signup_form");
    }

    public function signUp(SignUpRequest $request): RedirectResponse
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_active' => true
            ]);

            Auth::login($user);

            return redirect('/')->with('success', 'Hesabınız başarıyla oluşturuldu.');
        } catch (\Exception $e) {
            return back()->with('error', 'Kayıt olurken bir hata oluştu.');
        }
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/')->with('success', 'Başarıyla çıkış yaptınız.');
    }
}
