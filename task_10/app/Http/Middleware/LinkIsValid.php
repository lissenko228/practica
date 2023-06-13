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

        if(Auth::user())
        {
            if(Auth::user() -> id === $book -> user -> id) // проверка пользователя
            {
                return $next($request);
            }

            $read = DB::table('readers') -> where('user_id', $book -> user -> id)->where('reader_id', Auth::user() -> id) -> first();
    
            if($read !== null)
            {
                if(Auth::user() -> id === $read -> reader_id && $read -> accepted === 1) //проверка по доступу к библиотеке
                {
                    $book = Book::where('id', $bookId) -> first();
        
                    return $next($request);
                }
            }
        }

        if($book) // проверка по доступу по ссылке
        {
            $link = Link::where('book_id', $bookId) -> first();

            if( ! $link) return redirect() -> route('index');
            
            return $next($request);
        }
        
        return redirect() -> route('index');
    }
}
