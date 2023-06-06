<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{

    // добавить книгу
    public function add(Request $request, $userId)
    {
        $this->validate($request, [
            'title' => 'required|max:50',
            'text' => 'required|'
        ]);

        Book::create([
            'user_id' => $userId,
            'title' => $request->input('title'),
            'text' => $request->input('text'),
        ]);

        return redirect()->back()->with('info', 'Книга добавлена');
    }

    // читать книгу
    public function read($bookId)
    {
        $book=Book::find($bookId);

        if(Auth::user()->id===$book->user->id) // проверка пользователя
        {
            $book=Book::where('id', $bookId)->first();

            return view('library.book', [
                'book' => $book
            ]);
        }

        $read=DB::table('readers')->where('user_id', $book->user->id)->where('reader_id', Auth::user()->id)->first();

        if(Auth::user()->id===$read->reader_id && $read->accepted===1)
        {
            $book=Book::where('id', $bookId)->first();

            return view('library.book', [
                'book' => $book
            ]);
        }

        return redirect()->route('index');
        
    }

    // изменить книгу страница
    public function edit($bookId)
    {
        $book=Book::find($bookId);

        if(Auth::user()->id!==$book->user->id) // проверка пользователя
        {
            return redirect()->route('index');
        }

        $book=Book::where('id', $bookId)->first();

        return view('library.edit', [
            'book' => $book
        ]);
    }

    // изменить книгу
    public function postEdit(Request $request,$bookId)
    {
        $book=Book::find($bookId);

        if(Auth::user()->id!==$book->user->id)
        {
            return redirect()->route('index');
        }

        $this->validate($request,
        [
            'title' => 'max:50',
        ]);

        Book::where('id', $bookId)
              ->update(['title' => $request->input('title'),
                        'text' => $request->input('text')
            ]);
        
        return redirect()->route('edit', ['bookId' => $bookId])->with('info', 'Данные книги изменены');
    }

    // удалить книгу
    public function delete($bookId)
    {
        $book=Book::find($bookId);

        if(Auth::user()->id!==$book->user->id)
        {
            return redirect()->route('index');
        }

        Book::where('id', $bookId)->delete();

        return redirect()->route('profile', ['userId' => Auth::user()->id])->with('info', 'Книга успешно удалена');
    }

    // чтение книги по ссылке 
    public function readLink($bookId)
    {
        $book=Book::find($bookId);

        if(!$book) return redirect()->route('index');

        $link=DB::table('links')->where('user_id', $book->user->id)->first();

        if(!$link) return redirect()->back();

        if($book->user->id===$link->user_id)
        {
            return view('library.book', [
                'book' => $book
            ]);
        }

       return redirect()->back();
    }
}
