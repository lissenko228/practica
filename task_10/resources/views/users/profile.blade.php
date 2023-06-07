
@extends('templates/default')

@section('container')
<div class="row">
    <h2>Библиотека {{$user->surname." ".$user->name." ".$user->lastname}}</h2>
    <div class="row gap-3 mt-3">
        @if (Auth::user()->id===$user->id)
        <h4>Добавить книгу</h4>
        <form method="post" action="{{route('add', ['userId' => $user->id])}}" novalidate>
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Название</label>
                <input type="text" name="title" class="form-control {{$errors->has('title') ? ' is-invalid' : ''}}" id="title" placeholder="Название книги" value="{{Request::old('title') ?: ''}}">
                @if ($errors->has('title'))
                    <span class="help-block text-danger">
                        {{ $errors->first('title')}}
                    </span>
                @endif
            </div>
            <div class="mb-3">
                <label for="text" class="form-label">Текст</label>
                <textarea name="text" class="form-control {{$errors->has('title') ? ' is-invalid' : ''}}" placeholder="Текст книги" id="text" style="height: 100px">{{Request::old('text') ?: ''}}</textarea>
                @if ($errors->has('text'))
                    <span class="help-block text-danger">
                        {{ $errors->first('text')}}
                    </span>
                @endif
            </div>
            <button type="submit" class="btn btn-dark">Добавить</button>
        </form>
        <div>  
            @if ($link)
                Ссылка на библиотеку: http://library/links/{{$link->user_id}}
            @else
                <a href="{{route('link')}}" class="btn btn-primary">Поделиться библиотекой</a>
            @endif
        </div>
        @else
            @if ($reader)
                @if ($reader->accepted==1)
                    <a href="{{route('reader.del', ['userId' => $user->id])}}" type="button" class="btn btn-danger">Удалить доступ из библиотеки</a>
                @else
                    <a href="{{route('reader', ['userId' => $user->id])}}" type="button" class="btn btn-success">Дать доступ к своей библиотеке</a>
                @endif
            @else
                <a href="{{route('reader', ['userId' => $user->id])}}" type="button" class="btn btn-success">Дать доступ к своей библиотеке</a>
            @endif
        @endif
        <h4>Книги {{$user->surname." ".$user->name." ".$user->lastname}}</h4>
        @foreach ($books as $book)
            @include('library.books')
        @endforeach
    </div>
</div>
@endsection
