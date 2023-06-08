<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Book;
use App\Models\User;
use App\Models\Link;
use App\Models\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LinkController extends Controller
{
    public function getLink($bookId)
    {
        DB::table('links')->insert(['book_id' => $bookId]);

        $link=Link::where('book_id', $bookId)->first();

        return view('link.index', [
            'link' => $link
        ])->with('info', 'Книга расшарена');
    }

    public function LinkBook($bookId)
    {
        
        $book=Book::where('id', $bookId)->first();

        $reader='';

        $read_book='';

        $link=Link::where('book_id', $bookId)->first();

        if($link===null)
        {
            $link='';
        }


        return view('link.index', [
            'book' => $book,
            'reader' => $reader,
            'read_book' => $read_book,
            'link' => $link
        ]);
    }
}
