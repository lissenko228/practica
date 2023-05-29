<div class="d-flex align-items-center mb-2">
    <div class="flex-shrink-0">
        <a href="{{route('profile.index', ['username' => $user->username])}}">
            <img src="{{$user->getAvatarUrl()}}" alt="{{$user->getNameOrUsername()}}">
        </a>
    </div>
    <div class="flex-grow-1 ms-3">
        <a href="{{route('profile.index', ['username' => $user->username])}}">{{$user->getNameOrUsername()}}</a>
        @if ($user->location)
            <p>{{$user->location}}</p>
        @endif
    </div>
  </div>