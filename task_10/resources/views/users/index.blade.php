
@extends('templates/default')

@section('container')
<div class="row gap-3">
    @foreach ($users as $user)    
    <div class="card text-light bg-dark mb-3" style="max-width: 18rem;">
        <div class="card-header">{{$user->surname." ".$user->name." ".$user->lastname}}</div>
        <div class="card-body">
          <a href="{{route('profile', ['userId' => $user->id])}}" class="btn btn-light">Посмотреть профиль</a>
        </div>
      </div>
    @endforeach
</div>
@endsection
