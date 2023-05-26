@extends('templates/default')

@section('container')
<div class="row">
    <div class="col-lg-4 mx-auto">
        <h2>Войти</h2>
        <form method="post" action="{{route('auth.signin')}}" novalidate>
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control {{$errors->has('email') ? ' is-invalid' : ''}}" id="email" placeholder="example@mail.com" value="{{Request::old('email') ?: ''}}">
                @if ($errors->has('email'))
                    <span class="help-block text-danger">
                        {{ $errors->first('email')}}
                    </span>
                @endif
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" class="form-control {{$errors->has('password') ? ' is-invalid' : ''}}" id="password" name="password" placeholder="Минимум 6 символов">
                @if ($errors->has('password'))
                    <span class="help-block text-danger">
                        {{ $errors->first('password')}}
                    </span>
                @endif
            </div>
            <div class="mb-3 form-check">
                <input name="remember" type="checkbox" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Запомнить на этом устройстве</label>
              </div>
            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
    </div>
</div>
@endsection
