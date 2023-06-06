<div class="card border-dark mb-3" style="max-width: 18rem;">
    <div class="card-header">{{$book->title}}</div>
    <div class="row p-3 gap-3">
      @if (Auth::user()->id===$book->user_id)    
        <a href="{{route('book', ['bookId' => $book->id])}}" class="btn btn-info btn-sm">Прочитать</a>
        <a href="{{route('edit', ['bookId' => $book->id])}}" class="btn btn-dark btn-sm">Изменить</a>
        <a href="{{route('delete', ['bookId' => $book->id])}}" class="btn btn-danger btn-sm">Удалить</a>
      @endif

      {{-- @if (Auth::user()->id===$reader->user_id && $reader->accepted===1) --}}
        <a href="{{route('book', ['bookId' => $book->id])}}" class="btn btn-info btn-sm">Прочитать</a>
      {{-- @endif --}}
    </div>
  </div>