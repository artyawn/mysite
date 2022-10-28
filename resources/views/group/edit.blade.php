@extends('layouts.main')
@section('content')
<div class="row">


    <form action="{{route('group.delete',$group->id)}}" method="post">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger">удалить</button>
    </form>

    <br>


<div class="col-6">
    <form action="{{route('group.update',$group->id)}}"method="post">
        @csrf
        @method('patch')
        <input type="text" class="form-control" name="title"
               id="title" placeholder="Введите название группы" value={{$group->title}}><br>
        <input type="text" class="form-control" name="worker"
               id="mate" placeholder="Введите имя участника которого хотите добавить"><br>
        <button class="btn btn-primary" type="submit">Добавить</button><br>

    </form>
    @if (isset($msg))
    <h7>{{$msg}}</h7>
        @endif
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
