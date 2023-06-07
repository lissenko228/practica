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
        $book=Book::find($request);

        if(!$book) return redirect()->route('index');

        $link=Link::where('user_id', $book->user->id)->first();

        if(!$link) return redirect()->back();

        return $next($request);
    }
}
