@extends('templates/default')

@section('container')
<div class="row">
    <div class="col-lg-10">
        <h2>Ссылка на книгу: http://library/linkbook-read/{{$link->book_id}}</h2>
    </div>
</div>
@endsection
