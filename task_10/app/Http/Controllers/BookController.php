<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{

    // добавить книгу
    public function add(Request $request, $userId)
    {
        $this -> validate($request, [
            'title' => 'required|max:50',
            'text' => 'required|'
        ]);

        Book::create([
            'user_id' => $userId,
            'title' => $request -> input('title'),
            'text' => $request -> input('text'),
        ]);

        return redirect() -> back() -> with('info', 'Книга добавлена');
    }

    // читать книгу
    public function read($bookId)
    {
        $book = Book::find($bookId);

        return view('library.book', [
            'book' => $book
        ]);
        
    }

    // изменить книгу страница
    public function edit($bookId)
    {
        $book=Book::find($bookId);

        // проверка пользователя
        if (Auth::user() -> id !== $book -> user -> id) {
            return redirect() -> route('index');
        }

        return view('library.edit', [
            'book' => $book
        ]);
    }

    // изменить книгу
    public function postEdit(Request $request, $bookId)
    {
        $book = Book::find($bookId);

        if (Auth::user() -> id !== $book -> user -> id) {
            return redirect() -> route('index');
        }

        $this -> validate($request,
        [
            'title' => 'max:50',
        ]);

        $book -> update(
                [
                    'title' => $request -> input('title'),
                    'text' => $request -> input('text')
                ]);
        
        return redirect() -> route('edit', ['bookId' => $bookId]) -> with('info', 'Данные книги изменены');
    }

    // удалить книгу
    public function delete($bookId)
    {
        $book = Book::find($bookId);

        if (Auth::user() -> id !== $book -> user -> id) {
            return redirect() -> route('index');
        }

        $book -> delete();

        return redirect() -> route('profile', ['userId' => Auth::user() -> id])->with('info', 'Книга успешно удалена');
    }
}
