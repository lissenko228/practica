<?php

namespace App\Http\Middleware;
use App\Models\Book;
use App\Models\Link;

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

        if($book)
        {
            $link = Link::where('book_id', $bookId) -> first();

            if( ! $link) return redirect() -> route('index');
            
            return $next($request);
        }
        
        return redirect() -> route('index');
    }
}
