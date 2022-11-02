@extends('layouts.main')

@section('content')
    <div class=" row justify-content-center">
      <div class="text-center col-6">
    <main class="form-signin">
        <form action="{{route('signin')}}" method="post">
            @csrf
            @method('post')
            <h1 class="h3 mb-3 fw-normal">Вход</h1>
            <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="email" value="{{ old('email') }}">
                <label for="floatingInput">Email </label>
            </div>
            @error('email')
            <div class="small text-danger pt-1">{{ $message }}</div>
            @enderror
            <br>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="пароль">
                <label for="floatingPassword">Пароль</label>
            </div>
            @error('password')
            <div class="small text-danger pt-1">{{ $message }}</div>
            @enderror
            <br>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Войти</button>
        </form>
        @error('data')
            <div class="alert alert-danger">
                {{$message}}
            </div>
@enderror
      <h6 class="mt-3">Вы еще не зарегистрированы? Перейдите на страницу <a href="{{route('register')}}">регистрации</a> </h6>
    </main>

      </div>
    </div>

@endsection
