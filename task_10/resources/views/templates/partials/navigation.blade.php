<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="/">Library</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          @if (Auth::check())
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="{{route('users.index')}}">Пользователи</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('profile', ['userId' =>Auth::user()->id])}}">Моя Библиотека</a>
            </li>          
          </ul>
          @endif
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          @if (Auth::check())
            <li class="nav-item">
              <a class="nav-link" href="{{route('auth.logout')}}">Выйти</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{route('profile', ['userId' =>Auth::user()->id])}}">{{Auth::user()->getName()}}</a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="{{route('auth.signup')}}">Зарегистироваться</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('auth.signin')}}">Войти</a>
            </li>
            @endif
          </ul>
        </div>
  </div>
  </nav>