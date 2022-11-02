@extends('layouts.main')
@section('content')
    <a href="{{route('task.createOwn')}}" class="link-dark">
    Новая личная задача
    </a><br>
    <form action="{{route('task.custom')}}" method="post">
        @csrf
        @method('post')
<div class="row">
        <div class="col-6">
            <select name="group">
                <option value="" name="value">Все</option>
                <option @if (isset($group_id) and $group_id =='own')
                        selected @endif
                        value="own" name="value">Личные</option>
                @foreach($groups as $group)
                    <option @if (isset($group_id) and $group_id == $group->id)
                        selected
                        @endif
                            value="{{$group->id}}" name="value">{{$group->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6">
            <select name="status">
                <option @if (isset($is_done)) selected @endif value="">Все</option>
                <option @if (isset($is_done) and $is_done == '1') selected @endif value="1">Выполнено</option>
                <option @if (isset($is_done) and $is_done == '0') selected @endif value="0">Не выполнено</option>
            </select>
            <button type="submit" class="btn btn-primary btn-sm">Принять</button>
        </div>

    </div>
    </form>




    <div class="row">



        <div class="col-6">
                    <h5>Выполнение</h5>



            @foreach($tasks_left as $task)
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-9"><h4 class="my-0 font-weight-normal">{{$task->title}}</h4>
                               </div>
                            <div class="col-3">
                                <form action="{{route('task.editStatus',$task->id)}}" method="post">
                                    @csrf
                                    @method('patch')
                                    <button type="submit" class="btn btn-primary">Выполнено</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <h6 class="my-0 font-weight-normal mb-4 text-start">Описание:{{$task->content}}</h6>
                            <h6 class="my-0 font-weight-normal mb-4 text-start">Отправитель:{{$task->sender->name}}</h6>
                            @if(isset($task->group->title))
                            <h6 class="my-0 font-weight-normal mb-4 text-start">Группа:{{$task->group->title}}</h6>
                            @endif
                            <h6 class="my-0 font-weight-normal mb-4 text-start">Дата выполнения:{{date("d/m/Y", strtotime($task->date))}}</h6>
                        </ul>
                    </div>
                </div>
            @endforeach

        </div>


    <div class="col-6">
                <h5>Контроль</h5>
        @if(isset($tasks_right))
                @foreach($tasks_right as $task)
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-9"><h4 class="my-0 font-weight-normal">{{$task->title}}</h4>
                                    <a href="{{route('task.edit',$task->id)}}">Изменить</a></div>
                                <div class="col-3">
                                    <form action="{{route('task.delete',$task->id)}}" method="post">
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
                                @if(isset($task->group->title))
                                <h6 class="my-0 font-weight-normal mb-4 text-start">Группа:{{$task->group->title}}</h6>
                                @endif
                                <h6 class="my-0 font-weight-normal mb-4 text-start">Дата выполнения:{{date("d/m/Y", strtotime($task->date))}}</h6>
                            </ul>
                        </div>
                    </div>
        @endforeach
        @endif
            </div>
    </div>
@endsection
