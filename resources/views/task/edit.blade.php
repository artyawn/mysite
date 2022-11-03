@extends('layouts.main')
@section('title')
    <title>Редактирование задачи</title>
@endsection
@section('content')
    <div class="col-lg-6">
        <form action="{{route('task.update',$task->id)}}" method="post">
            @csrf
            @method('patch')
            <input type="text" class="form-control" name="title"
                   placeholder="Введите заголовок задачи" value="{{$task->title}}"><br>
            <textarea class="form-control" name="content"
                      rows="7"  placeholder="Введите задачу">{{$task->content}}</textarea><br>
            <input type="date" class="form-control" name="date"
                   placeholder="Введите дату исполнения" value="{{$task->date}}"><br>
            <button class="btn btn-primary" type="submit">Изменить</button><br>
        </form>
    </div>
@endsection
