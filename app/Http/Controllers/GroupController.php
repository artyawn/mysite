<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Service\Group\Service;

class GroupController extends Controller
{

    public function index(Service $service)
    {
        return view('group.index',$service->index());
    }

    public function custom(Service $service,Request $request, Group $group)
    {
        $worker_id = $request->input('worker');
        return view('group.show', $service->custom($group,$worker_id));
    }


    public function create()
    {
        return view('group.create');
    }


    public function store(Service $service,Request $request)
    {
        $data = $request->validate(['title' => 'required|string|max:100']);
        return $service->store($data);


    }

    public function show(Group $group)
    {
        $tasks = $group->tasks;
        $workers = $group->users;
        return view('group.show', compact('workers', 'tasks', 'group'));
    }


    public function edit(Group $group)
    {
        $users = $group->users;
        return view('group.edit', compact('group', 'users'));
    }


    public function addWorker(Service $service,Request $request, Group $group)
    {
        $worker = $request->validate(['worker'=>'required|string|max:100']);
        $service->addWorker($worker,$group);
        return redirect(route('group.edit',$group->id));
    }


    public function updateTitle(Service $service,Request $request, Group $group){
        $title=$request->validate(['title' => 'required|string|max:100']);
        $service->updateTitle($title,$group);
        return redirect(route('group.edit',$group->id));
    }


    public function deleteWorker(Group $group,User $user)
    {
        $group->users()->detach($user->id);
        return redirect(route('group.edit',compact('group')));
    }


    public function destroy(Group $group)
    {
        $group->delete();
        return redirect(route('group.index'));
    }
}
