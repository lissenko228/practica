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
        $link=Link::where('book_id', $bookId)->first();

        if($link)
        {
            return redirect()->back()->with('info', 'Книга уже расшарена');
        }

        Link::create(['book_id' => $bookId]);

        return redirect()->back()->with('info', 'Книга расшарена');
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
