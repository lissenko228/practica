@extends('templates/default')

@section('container')
<div class="row">
    <div class="col-lg-6">
        <h1>{{$book->title}}</h1>
        <p>{{$book->text}}</p>
    </div>
</div>
@endsection
