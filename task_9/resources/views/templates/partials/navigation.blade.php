<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
      <a class="navbar-brand" href="{{route('home')}}">Social</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        @if (Auth::check())
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('home')}}">Стена</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('friend.index')}}">Друзья</a>
          </li>
          <li class="nav-item">
            <form method="get" action="{{route('search.results')}}" class="d-flex">
              <input name="query" class="form-control me-2" type="search" placeholder="Что ищем" aria-label="Search">
              <button class="btn btn-success" type="submit">Найти</button>
            </form>
          </li>              
        </ul>
        @endif
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        @if (Auth::check())
            
          <li class="nav-item">
            <a class="nav-link active" href="{{route('profile.index', ['username' => Auth::user()->username])}}">{{Auth::user()->getNameOrUsername()}}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('profile.edit')}}">Обновить профиль</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('auth.signout')}}">Выйти</a>
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