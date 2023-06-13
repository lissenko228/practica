<?php

namespace App\Http\Middleware;

use App\Models\Book;
use App\Models\Link;
use Illuminate\Support\Facades\DB;
use Auth;

use Closure;

class LinkIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $bookId = explode('/', $request);
        $bookId = $bookId[2];
        $bookId = explode(' ', $bookId);
        $bookId = $bookId[0];

        $book = Book::where('id', $bookId) -> first();

        if (Auth::user()) {
            
            // проверка пользователя
            if (Auth::user() -> id === $book -> user -> id) { 
                return $next($request);
            }

            //проверка по доступу к библиотеке
            if (DB::table('readers') -> 
            where([['user_id', $book -> user -> id], ['reader_id', Auth::user() -> id], ['accepted', 1]]) -> 
            first()) {
                $book = Book::where('id', $bookId) -> first();
    
                return $next($request);
            }
        }

        // проверка по доступу по ссылке
        if ($book) {
            $link = Link::where('book_id', $bookId) -> first();

            if( ! $link) return redirect() -> route('index');
            
            return $next($request);
        }
        
        return redirect() -> route('index');
    }
}
