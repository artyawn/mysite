@extends('layouts.main')
@section('title')
    <title>Регистрация</title>
@endsection
@section('content')
    <div class=" row justify-content-center">
        <div class="text-center col-6">

        <main class="form-signin">
            <form action="{{route('user.store')}}" method="post">
                @method('post')
                @csrf
                <h1 class="h3 mb-3 fw-normal">Регистрация</h1>

                <div class="form-floating">
                    <input type="name" class="form-control" id="name" name="name" placeholder="Имя" value="{{old('name')}}">
                    <label for="floatingInput">Имя </label>
                </div>
                @error('name')
                <div class="small text-danger pt-1">{{$message }}</div>
                @enderror
                <br>
                <div class="form-floating">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{old('email')}}">
                    <label for="floatingInput">Email </label>
                </div>
                @error('email')
                <div class="small text-danger pt-1">{{$message}}</div>
                @enderror
                <br>

                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="пароль">
                    <label for="floatingPassword">Пароль</label>
                    @error('password')
                    <div class="small text-danger pt-1">{{ $message }}</div>
                    @enderror
                </div>
                <br>
                <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Регистрация</button>

            </form>
            @error('data')
            <div class="small text-danger pt-1">{{ $message }}</div>
            @enderror
            <h6 class="mt-3">Увас уже есть аккаунт? Перейдите на страницу <a href="{{route('login')}}">аторизации</a> </h6>
        </main>

    </div>
    </div>



@endsection
