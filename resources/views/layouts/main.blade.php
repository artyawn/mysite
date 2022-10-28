<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
          crossorigin="anonymous">
    <title>Document</title>
    <link href="../../css/app.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="{{route('task.index')}}" class="nav-link px-2 link-dark">Задачи</a></li>
            <li><a href="{{route('group.index')}}" class="nav-link px-2 link-dark">Группы</a></li>
        </ul>
        <div class="col-md-4 text-end">
            @if (\Illuminate\Support\Facades\Auth::check())
            <a class="nav-link px-2 link-dark">{{auth()->user()->name}}</a>
                @endif
        </div>
        <div class="col-md-1 text-end">
            <a href="{{route('logout')}}">Выход</a>
        </div>
    </header>
    @yield('content')
</div>



</body>
</html>
