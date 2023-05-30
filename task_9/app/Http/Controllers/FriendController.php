<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    // мои друзья
    public function getIndex()
    {
        return view('friends.index' , [
            'friends' => Auth::user()->friends(),
            'requests' => Auth::user()->friendRequests()
        ]);
    }

    public function getAdd($username)
    {
        $user = User::where('username', $username)->first();

        if(!$user)
        {
            return redirect()->route('home')->with('info', 'Пользователь не найден');
        }

        if(Auth::user()->id===$user->id)
        {
            return redirect()->route('home');
        }

        if(Auth::user()->hasfriendRequestsPending($user) || $user->hasfriendRequestsPending(Auth::user()))
        {
            return redirect()->route('profile.index', ['username' => $user->username])->with('info', 'Пользователю отправлен запрос в друзья');
        }

        if(Auth::user()->isFriendWith($user))
        {
            return redirect()->route('profile.index', ['username' => $user->username])->with('info', 'Пользователь уже в друзьях');
        }

        Auth::user()->addFriend($user);

        return redirect()->route('profile.index', ['username'=>$username])->with('info', 'Пользователю отправлена заявка в друзья');
    }

    public function getAccept($username)
    {
        $user = User::where('username', $username)->first();

        if(!$user)
        {
            return redirect()->route('home')->with('info', 'Пользователь не найден');
        }

        if(!Auth::user()->hasfriendRequestsReceived($user))
        {
            return redirect()->route('home');
        }

        Auth::user()->acceptFriendRequests($user);

        return redirect()->route('profile.index', ['username' => $username])->with('info', 'Запрос в друзья принят');
    }

    public function postDelete($username)
    {
        $user = User::where('username', $username)->first();

        if(!Auth::user()->isFriendWith($user))
        {
            return redirect()->back();
        }

        Auth::user()->deleteFriend($user);

        return redirect()->back()->with('info', 'Пользователь удален из друзей');
    }

}

