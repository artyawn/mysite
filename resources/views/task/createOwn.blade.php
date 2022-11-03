@extends('layouts.main')
@section('title')
    <title>Новая личная задача</title>
@endsection
@section('content')
    <div class="col-lg-6">
        <form action="{{route('task.storeOwn')}}" method="post">
            @csrf
            @method('post')
            <input type="text" class="form-control" name="title"
                    placeholder="Введите заголовок задачи" value="{{ old('title') }}">
            @error('title')
            <div class="small text-danger pt-1">{{ $message }}</div>
            @enderror
            <br>
            <textarea class="form-control" name="content" rows="7"  placeholder="Введите задачу">{{ old('content') }}</textarea>
            @error('content')
            <div class="small text-danger pt-1">{{ $message }}</div>
            @enderror
            <br>
            <input type="date" class="form-control" name="date"
                   placeholder="Введите дату исполнения" value="{{ old('date') }}">
            @error('date')
            <div class="small text-danger pt-1">{{ $message }}</div>
            @enderror
            <br>
            <button class="btn btn-primary" type="submit">Создать</button><br>
        </form>
    </div>
@endsection
