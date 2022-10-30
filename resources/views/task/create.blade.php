@extends('layouts.main')
@section('content')
    <div class="col-lg-6">
        <form action="{{route('task.store')}}" method="post">
            @csrf
            @method('post')
            <input type="text" class="form-control" name="title"
                    placeholder="Введите заголовок задачи" value="{{ old('title') }}">
            @error('title')
            <div class="small text-danger pt-1">{{ $message }}</div>
            @enderror<br>
            <textarea class="form-control" name="content" rows="7"  placeholder="Введите задачу">{{ old('content') }}</textarea>
            @error('content')
            <div class="small text-danger pt-1">{{ $message }}</div>
            @enderror
            <br>

            <h6>Группа</h6>
            <select name="group_id">
                <option  value="{{$group->id}}" name="value" >{{$group->title}}</option></select><br>
            <h6>Выберете работника</h6>
            <select name="worker_id">
                <option value="" name="value">Все</option>
                @foreach($workers as $worker)
                    <option value="{{$worker->id}}" name="value" >{{$worker->name}}</option>
                @endforeach
            </select><br>
            <input type="date" class="form-control mt-3" name="date" value="{{ old('date') }}"
                   placeholder="Введите дату исполнения">
            @error('date')
            <div class="small text-danger pt-1">{{ $message }}</div>
            @enderror<br>
            <button class="btn btn-primary" type="submit">Создать</button><br>
        </form>
    </div>
@endsection
