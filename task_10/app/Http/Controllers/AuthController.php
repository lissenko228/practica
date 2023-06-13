<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getSignup()
    {
        return view('auth.signup');
    }

    public function postSignup(Request $request)
    {
        $this -> validate($request, [
            'email' => 'required|unique:users|email|max:255',
            'surname' => 'required|alpha_dash|max:30',
            'name' => 'required|alpha_dash|max:30',
            'lastname' => 'max:30',
            'password' => 'required|min:6',
        ]);

        User::create([
            'email' => $request -> input('email'),
            'surname' => $request -> input('surname'),
            'name' => $request -> input('name'),
            'lastname' => $request -> input('lastname'),
            'password' => bcrypt($request -> input('password')),
        ]);

        return redirect() -> route('index') -> with('info', 'Вы зарегистировались');
    }

    public function getSignin()
    {
        return view('auth.signin');
    }

    public function postSignin(Request $request)
    {
        $this -> validate($request, [
            'email' => 'required|max:255',
            'password' => 'required|min:6',
        ]);

        if ( ! Auth::attempt($request -> only(['email', 'password']))) {
            return redirect() -> back() -> with('info', 'Неправильный логин или пароль');
        }
        
        return redirect() -> route('index') -> with('info', 'Вы успешно авторизовались');
    }

    public function logout()
    {
        Auth::logout();

        return redirect() -> route('index');
    }
}
