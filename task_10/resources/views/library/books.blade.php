<div class="card border-dark mb-3" style="max-width: 18rem;">
    <div class="card-header">{{$book->title}}</div>
    <div class="row p-3 gap-3">
      <a href="{{route('book', ['bookId' => $book->id])}}" class="btn btn-info btn-sm">Прочитать</a>
      @if (Auth::user()->id===$book->user_id)    
        <a href="{{route('edit', ['bookId' => $book->id])}}" class="btn btn-dark btn-sm">Изменить</a>
        <a href="{{route('delete', ['bookId' => $book->id])}}" class="btn btn-danger btn-sm">Удалить</a>
      @endif
    </div>
  </div>