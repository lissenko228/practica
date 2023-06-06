@extends('templates/default')

@section('container')
<div class="row">
    <div class="col-lg-10">
        <h2>Библиотека {{$user->surname." ".$user->name." ".$user->lastname}}</h2>
    </div>
    <h4>Книги {{$user->surname." ".$user->name." ".$user->lastname}}</h4>
        @foreach ($books as $book)
            @include('library.books')
        @endforeach
</div>
@endsection
