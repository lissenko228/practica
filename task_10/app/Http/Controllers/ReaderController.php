<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReaderController extends Controller
{
    // добавить читателя
    public function addReader($userId)
    {
        if(Auth::user()->id==$userId)
        {
            return redirect()->route('index'); //проверка пользователя
        }

        DB::table('readers')->insert([
            'user_id' => Auth::user()->id,
            'reader_id' => $userId
        ]);

        return redirect()->back()->with('info', 'Пользователю предоставлен доступ к библиотеке');

    }
}
