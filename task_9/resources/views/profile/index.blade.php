@extends('templates/default')

@section('container')
<div class="row">
    <div class="col-lg-6 ">
        @include('user.partials.userblock')
        <hr>

        @if (!$statuses->count())

        <p>{{$user->getFirstNameOrUsername()}} пока ничего нет</p>

        @else
        @foreach ($statuses as $status)
            
    <div class="media">
        <div class="line-media-body">
            <a class="me-3" href="{{route('profile.index', ['username' => $status->user->username])}}">
                <img class="media-object rounded" src="{{$status->user->getAvatarUrl()}}" alt="{{$status->user->getNameOrUsername()}}">
            </a>
            <h4>
                <a href="{{route('profile.index', ['username' => $status->user->username])}}">{{$status->user->getNameOrUsername()}}</a>
            </h4>
        </div>
        <div class="media-body ms-5">
            <p>{{$status->body}}</p>
            <ul class="list-inline">
                <li class="list-inline-item">{{$status->created_at->diffForHumans()}}</li>
                @if ($status->user->id!==Auth::user()->id)
                        
                        <li class="list-inline-item">
                            <a href="{{route('status.like', ['statusId' => $status->id])}}">Лaйк</a>
                        </li>
                        
                    @endif
                <li class="list-inline-item">
                    {{$status->likes->count()}} {{Str::plural('like', $status->likes->count())}}
                </li>
                @if ($status->user->id==Auth::user()->id)
                        
                    <li class="list-inline-item">
                        <a class="btn btn-dark btn-sm" href="{{route('status.delete', ['statusId' => $status->id])}}">Удалить</a>
                    </li>
                        
                @endif
            </ul>

            @foreach ($status->replies as $reply)
            
            <div class="media">
                <div class="line-media-body">
                    <a class="me-3" href="{{route('profile.index', ['username' => $reply->user->username])}}">
                        <img class="media-object rounded" src="{{$reply->user->getAvatarUrl()}}" alt="{{$reply->user->getNameOrUsername()}}">
                    </a>
                    <h4>
                        <a href="{{route('profile.index', ['username' => $reply->user->username])}}">{{$reply->user->getNameOrUsername()}}</a>
                    </h4>
                </div>
                <div class="media-body">
                    <p>{{$reply->body}}</p>
                    <ul class="list-inline">
                        <li class="list-inline-item">{{$reply->created_at->diffForHumans()}}</li>
                        @if ($reply->user->id!==Auth::user()->id)
                            <li class="list-inline-item">
                                <a href="{{route('status.like', ['statusId' => $reply->id])}}">Лaйк</a>
                            </li>
                        @endif
                        <li class="list-inline-item">
                            {{$reply->likes->count()}} {{Str::plural('like', $reply->likes->count())}}
                        </li>
                        @if ($reply->user->id==Auth::user()->id)
                        
                            <li class="list-inline-item">
                                <a class="btn btn-dark btn-sm" href="{{route('status.delete', ['statusId' => $reply->id])}}">Удалить</a>
                            </li>
                            
                        @endif
                    </ul>
                </div>
            </div>

            @endforeach

            @if ($authUserIsFriend || Auth::user()->id===$status->user->id)
                

            <form method="POST" action="{{route('status.reply', ['statusId' => $status->id])}}" class="mb-4">
            @csrf
                <div class="form-group mb-2">
                    <textarea name="reply-{{$status->id}}" class="form-control {{$errors->has("reply-{$status->id}") ?' is-invalid' : ''}}" placeholder="Прокомментировать" rows="3"></textarea>

                    @if ($errors->has("reply-{$status->id}"))

                    <span class="help-block text-danger">
                        {{ $errors->first("reply-{$status->id}")}}
                    </span>

                    @endif

                </div>
                <input type="submit" class="btn btn-dark btn-sm" value="Oтветить">
            </form>

            @endif
        </div>
    </div>
        @endforeach

        {{-- {{$statuses->links()}} --}}

        @endif

    </div>
    <div class="col-lg-6 col-lg-offset-3">

        @if (Auth::user()->hasfriendRequestsPending($user))

            <p>В ожидании {{$user->getFirstNameOrUsername()}} подтверждения запроса в друзья</p>

        @elseif(Auth::user()->hasfriendRequestsReceived($user))

            <a href="{{route('friend.accept', ['username' => $user->username])}}" class="btn btn-dark mb-2">Подтвердить запрос в друзья</a>

        @elseif(Auth::user()->isFriendWith($user))

            {{$user->getFirstNameOrUsername()}} у вас в друзьях
            <form action="{{route('friend.delete', ['username' => $user->username])}}" method="post">
            @csrf
            <input type="submit" class="btn btn-dark my-2" value="Удалить из друзей">
            </form>
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
