<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreOwnRequest;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Models\Group;
use App\Models\Task;
use App\Service\Task\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{

    public function index(Service $service)
    {
        $data = $service->index();
        return view('task.index', $data);
    }

    public function custom(Request $request, Service $service)
    {
        $group = $request->input('group');
        $status = $request->input('status');
        return view('task.index', $service->custom($group, $status));
    }


    public function createOwn()
    {
        return view('task.createOwn');
    }


    public function storeOwn(StoreOwnRequest $request, Service $service)
    {
        $data = $request->validated();
        $service->storeOwn($data);
        return redirect(route('task.index'));
    }


    public function create(Group $group)
    {
        $workers = $group->users;
        return view('task.create', compact('group', 'workers'));
    }


    public function store(StoreRequest $request, Service $service)
    {
        $data=$request->validated();
        $service->store($data);
        return redirect(route('group.show', $data['group_id']));
    }



    public function edit(Task $task)
    {
        return view('task.edit', compact('task'));
    }

    public function update(Task $task, UpdateRequest $request, Service $service)
    {
        $data = $request->validated();
        $service->update($data, $task);
        return redirect()->route('task.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('task.index');
    }

    public function editStatus(Task $task, Service $service)
    {
        $service->editStatus($task);
        return redirect(route('task.index'));
    }
}
