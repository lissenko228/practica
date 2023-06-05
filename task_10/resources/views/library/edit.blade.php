@extends('templates/default')

@section('container')
<div class="row">
    <div class="col-lg-6">
        <h2>Изменить книгу имя</h2>
        <form method="post" action="{{route('edit', ['bookId' => $book->id])}}" novalidate>
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Название</label>
                <input type="text" name="title" class="form-control {{$errors->has('title') ? ' is-invalid' : ''}}" id="title" placeholder="Название книги" value="{{$book->title}}">
                @if ($errors->has('title'))
                    <span class="help-block text-danger">
                        {{ $errors->first('title')}}
                    </span>
                @endif
            </div>
            <div class="mb-3">
                <label for="text">Текст</label>
                <textarea name="text" class="form-control" placeholder="Текст книги" id="text" style="height: 100px">{{$book->text}}</textarea>
                @if ($errors->has('text'))
                    <span class="help-block text-danger">
                        {{ $errors->first('text')}}
                    </span>
                @endif
            </div>
            <button type="submit" class="btn btn-dark">Изменить</button>
        </form>
    </div>
</div>
@endsection
