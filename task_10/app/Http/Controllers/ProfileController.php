<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Book;
use App\Models\User;
use App\Models\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function profile($userId)
    {
        $user=User::where('id', $userId)->first();
        
        $books=$user->books()->get();

        $reader = DB::table('readers')->where('user_id', Auth::user()->id)->where('reader_id', $user->id)->first();

        if($reader==null)
        {
            $reader='';
        }

        if(!$user) abort(404);

        return view('users.profile', [
            'user' => $user,
            'books' => $books,
            'reader' => $reader
        ]);
    }
}
