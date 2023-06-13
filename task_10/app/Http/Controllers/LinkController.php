<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Link;

class LinkController extends Controller
{
    public function getLink($bookId)
    {

        if (Link::where('book_id', $bookId) -> first()) {
            return redirect() -> back() -> with('info', 'Книга уже расшарена');
        }

        Link::create(['book_id' => $bookId]);

        return redirect() -> back() -> with('info', 'Книга расшарена');
    }

}
