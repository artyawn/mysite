@extends('layouts.main')
@section('title')
    <title>Создание группы</title>
@endsection
@section('content')
    <div class="row">
    <div class="col-lg-6">

            <form action="{{route('group.store')}}" method="post">
                @csrf
                @method('post')
                <input type="text" class="form-control" name="title"
                       id="title" placeholder="Введите название группы" value="{{old('title')}}">
                @error('title')
                <div class="small text-danger pt-1">{{$message}}</div>
                @enderror
                <br>
               <button type="submit" class="btn btn-primary btn-sm">Создать</button>
    </form>
    </div>
    </div>
@endsection
