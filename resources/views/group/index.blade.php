@extends('layouts.main')
@section('content')
    <a href="{{route('group.create')}}" class="link-dark">
        <h6>Новая группа</h6></a>
<div class="row">

    <div class="col-6">
        <h5>Руководитель</h5>
        @foreach($groups_left as $group)
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <a href="{{route('group.show',$group->id)}}"><h4 class="my-0 font-weight-normal">{{$group->title}}</h4></a>
                    <a href="{{route('group.edit',$group->id)}}">Изменить</a>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <h6 class="my-0 font-weight-normal mb-4 text-start">Количество участников:{{count($group->users)}}</h6>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>


    <div class="col-6">
        <h5>Участник</h5>
        @foreach($groups_right as $group)
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">{{$group->title}}</h4></a>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <h6 class="my-0 font-weight-normal mb-4 text-start">Создатель:{{$group->creator->name}}</h6>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
