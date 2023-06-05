@extends('templates/default')

@section('container')
<div class="row">
    <div class="col-lg-4 mx-auto">
        <h2>Регистрация</h2>
        <form method="post" action="{{route('auth.signup')}}" novalidate>
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
                <label for="surname" class="form-label">Фамилия</label>
                <input type="text" class="form-control {{$errors->has('surname') ? ' is-invalid' : ''}}" id="surname" name="surname" placeholder="Иванов" value="{{Request::old('surname') ?: ''}}">
                @if ($errors->has('surname'))
                    <span class="help-block text-danger">
                        {{ $errors->first('surname')}}
                    </span>
                @endif
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
                <input type="text" class="form-control {{$errors->has('name') ? ' is-invalid' : ''}}" id="name" name="name" placeholder="Иван" value="{{Request::old('name') ?: ''}}">
                @if ($errors->has('name'))
                    <span class="help-block text-danger">
                        {{ $errors->first('name')}}
                    </span>
                @endif
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Отчество (не обязательно)</label>
                <input type="text" class="form-control {{$errors->has('lastname') ? ' is-invalid' : ''}}" id="lastname" name="lastname" placeholder="Иванович" value="{{Request::old('lastname') ?: ''}}">
                @if ($errors->has('lastname'))
                    <span class="help-block text-danger">
                        {{ $errors->first('lastname')}}
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
            <button type="submit" class="btn btn-dark">Зарегистироваться</button>
        </form>
    </div>
</div>
@endsection
