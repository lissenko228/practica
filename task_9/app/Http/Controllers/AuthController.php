<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getSignUp()
    {
        return view('auth.signup');
    }

    public function postSignUp(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users|email|max:255',
            'username' => 'required|unique:users|alpha_dash|max:20',
            'password' => 'required|min:6',
        ]);

        User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
        ]);
        
        return redirect()->route('home')->with('info', 'Вы успешно зарегистировались! Можно войти в аккаунт.');
    }

    public function getSignIn()
    {
        return view('auth.signin');
    }

    public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|max:255',
            'password' => 'required|min:6',
        ]);

        if(!Auth::attempt($request->only(['email', 'password']), $request->has('remember')))
        {
            return redirect()->back()->with('info', 'Неправильный логин или пароль.');
        }
        
        return redirect()->route('home')->with('info', 'Вы успешно авторизовались');
            
    }
}
