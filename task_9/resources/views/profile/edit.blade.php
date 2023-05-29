@extends('templates/default')

@section('container')
<div class="row">
    <div class="col-lg-6">
        <h3>Редактирование</h3>
        <form method="post" action="{{route('profile.edit')}}" novalidate>
            @csrf
            <div class="mb-3">
                <label for="first_name" class="form-label">Ваше имя</label>
                <input type="text" name="first_name" class="form-control {{$errors->has('first_name') ? ' is-invalid' : ''}}" id="first_name" value="{{Request::old('first_name') ?:Auth::user()->first_name}}">
                @if ($errors->has('first_name'))
                    <span class="help-block text-danger">
                        {{ $errors->first('first_name')}}
                    </span>
                @endif
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Ваша фамилия</label>
                <input type="text" class="form-control {{$errors->has('last_name') ? ' is-invalid' : ''}}" id="last_name" name="last_name" value="{{Request::old('last_name') ?:Auth::user()->last_name}}">
                @if ($errors->has('last_name'))
                    <span class="help-block text-danger">
                        {{ $errors->first('last_name')}}
                    </span>
                @endif
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Местоположение</label>
                <input type="text" class="form-control {{$errors->has('location') ? ' is-invalid' : ''}}" id="location" name="location" value="{{Request::old('location') ?:Auth::user()->location}}">
                @if ($errors->has('location'))
                    <span class="help-block text-danger">
                        {{ $errors->first('location')}}
                    </span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Обновить профиль</button>
        </form>
    </div>
</div>
@endsection
