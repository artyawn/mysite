@extends('layouts.main')
@section('content')
<div class="row">
    <a href="{{route('group.index')}}" class="link-dark ">
        Закончить редактирование
    </a><br>
<div class="col-6">
    <div class="row">
        <div class="col-10">
    <form action="{{route('group.updateTitle',$group->id)}}" method="post">
        @csrf
        @method('patch')
        <input type="text" class="form-control" name="title"
               id="title" placeholder="Введите название группы" value={{$group->title}}>
        @error('title')
        <div class="small text-danger pt-1">{{$message}}</div>
        @enderror
        </div>
        <div class="col-2">
            <button class="btn btn-primary" type="submit">Изменить</button><br>
        </div>
    </form>
    </div>


    <div class="row">
        <div class="col-10">
    <form action="{{route('add.worker',$group->id)}}"method="post">
        @csrf
        @method('post')
        <input type="text" class="form-control mt-3" name="worker"
               id="mate" placeholder="Введите имя участника которого хотите добавить">
        @error('worker')
        <div class="small text-danger pt-1">{{$message}}</div>
        @enderror
        </div>

    <div class="col-2">
        <button class="btn btn-primary  mt-3" type="submit">Добавить</button><br>
    </div><br>
    </form>
    </div>

    <form action="{{route('group.delete',$group->id)}}" method="post">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger mt-3">удалить группу</button>
    </form>

    <br>
</div>



    <div class="col-6">
        @foreach($users as $user)
        <div class="card">
            <div class="card-body">
                <form action="{{route('delete.worker',['group'=>$group->id,'user'=>$user->id])}}" method="post">
                    @csrf
                    @method('delete')
                <div class="row">
                    <div class="col-10">
                        <h5>{{$user->name}}</h5>
                        <h6>{{$user->email}}</h6>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </div>
                </div>
                </form>
            </div>
    </div>
            <br>
        @endforeach

</div>
</div>

@endsection
