<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Book;
use App\Models\User;
use App\Models\Link;
use App\Models\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Summary of ProfileController
 */
class ProfileController extends Controller
{
    /**
     * Summary of profile
     * @param mixed $userId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile($userId)
    {
        $user = User::where('id', $userId) -> first();
        
        $books = $user -> books() -> get();

        $reader = Reader::where('user_id', Auth::user() -> id) -> where('reader_id', $userId) -> first();

        if($reader === null) {
            $reader = '';
        }

        $read_book = Reader::where('user_id', $userId) -> where('reader_id', Auth::user() -> id) -> first();

        if($read_book === null) {
            $read_book = '';
        }

        if( ! $user) abort(404);

        return view('users.profile', [
            'user' => $user,
            'books' => $books,
            'reader' => $reader,
            'read_book' => $read_book,
        ]);
    }
}
