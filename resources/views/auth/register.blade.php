@extends('layouts.main')

@section('content')



    <div class="text-center">

        <main class="form-signin">
            <form action="{{route('user.store')}}" method="post">
                @method('post')
                @csrf
                <h1 class="h3 mb-3 fw-normal">Регистрация</h1>

                <div class="form-floating">
                    <input type="name" class="form-control" id="name" name="name" placeholder="Имя" value="{{ old('name') }}">
                    <label for="floatingInput">Имя </label>
                </div>
                @error('name')
                <div class="small text-danger pt-1">{{ $message }}</div>
                @enderror
                <br>

                <div class="form-floating">
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}">
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
                <button class="w-100 btn btn-lg btn-primary" type="submit">Регистрация</button>

            </form>
            @error('data')
            <div class="small text-danger pt-1">{{ $message }}</div>
            @enderror
        </main>

    </div>




@endsection
