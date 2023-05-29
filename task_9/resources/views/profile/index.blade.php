@extends('templates/default')

@section('container')
<div class="row">
    <div class="col-lg-6 ">
        @include('user.partials.userblock')
    </div>
    <div class="col-lg-6 col-lg-offset-3">

        @if (Auth::user()->hasfriendRequestsPending($user))

            <p>В ожидании {{$user->getFirstNameOrUsername()}} подтверждения запроса в друзья</p>

        @elseif(Auth::user()->hasfriendRequestsReceived($user))

            <a href="{{route('friend.accept', ['username' => $user->username])}}" class="btn btn-dark mb-2">Подтвердить запрос в друзья</a>

        @elseif(Auth::user()->isFriendWith($user))

            {{$user->getFirstNameOrUsername()}} у вас в друзьях

        @elseif(Auth::user()->id !== $user->id)

            <a href="{{route('friend.add', ['username' => $user->username])}}" class="btn btn-dark mb-2">Добавить в друзья</a>

        @endif

        <h4>{{$user->getFirstNameOrUsername()}} друзья</h4>

        @if (!$user->friends()->count())

            <p>{{$user->getFirstNameOrUsername()}} нет друзей</p>
            
        @else
            @foreach ($user->friends() as $user)
                @include('user.partials.userblock')
            @endforeach
        @endif
    </div>
</div>
@endsection
