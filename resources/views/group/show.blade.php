@extends('layouts.main')
@section('content')
    <div class="row">
    <div class="col-6">

        <div class="row">
        <div class="col-6"><h5>Задачи для группы {{$group->title}}</h5><br></div>
        <div class="col-6"><a class="text-black" href="{{route('task.create',$group)}}">Новая задача</a> </div>
        </div>


    </div>
       <form action="{{route('group.custom',$group)}}" method="post">
           @csrf
           @method('get')
            <div class="col-6">
                <select name="worker">
                    <option @if (isset($worker_id)==false) selected @endif  value="" name="value">Все</option>
                    @foreach($workers as $worker)
                        <option @if (isset($worker_id) and $worker_id==$worker->id)
                            selected @endif
                            value="{{$worker->id}}" name="value">{{$worker->name}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary btn-sm">Принять</button>
            </div>
       </form>


        <div class="col-6">
            @foreach($tasks as $task)
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-9"><h4 class="my-0 font-weight-normal">{{$task->title}}</h4>
                                    <a href="{{route('task.edit',$task->id)}}">Изменить</a></div>
                                <div class="col-3">
                                    <form action="{{route('group.task.delete',['group'=>$group->id,'task'=>$task->id])}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">удалить</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <h6 class="my-0 font-weight-normal mb-4 text-start">Описание:{{$task->content}}</h6>
                                <h6 class="my-0 font-weight-normal mb-4 text-start">
                                    Исполнитель:{{$task->worker->name}}</h6>
                                <h6 class="my-0 font-weight-normal mb-4 text-start">Группа:{{$task->group->title}}</h6>
                                <h6 class="my-0 font-weight-normal mb-4 text-start">Дата:{{$task->date}}</h6>
                            </ul>
                        </div>
                    </div>
                @endforeach

        </div>

    </div>
@endsection
