<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Task;
use App\Models\User;
use App\Service\Task\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class GroupController extends BaseController
{

    var $group_models;
    public function __construct()
    {
        $this->group_models=Group::all();
    }

    public function index()
    {
        $groups_left = $groups_right=$this->group_models;
        return view('group.index', compact('groups_left','groups_right'));
    }

    public function custom(Request $request, Group $group)
    {
        $tasks = Task::all()->where('group_id', $group->id);
        $worker_id = $request->input('worker');
        $workers = $group->users;
        if ($worker_id) {
            $tasks = Task::all()->where('group_id', $group->id)->where('worker_id', $worker_id);
        }
        return view('group.show', compact('workers', 'tasks', 'group', 'worker_id'));
    }


    public function create()
    {
        return view('group.create');
    }


    public function store(Request $request)
    {
        $data = $request->validate(['title' => 'required|string|max:100']);
        $data['creator'] = Auth::user()->id;
        if (Group::where('creator',$data['creator'])->where('title', $data['title'])->exists()) {
            return redirect(route('group.create'))->withErrors([
                'title' => 'Вы уже создавали группу с таким названием'
            ]);
        }
            Group::create($data);
            return redirect(route('group.index'));
    }

    public function show(Group $group)
    {
        $tasks = Task::all()->where('group_id', $group->id);
        $workers = $group->users;
        return view('group.show', compact('workers', 'tasks', 'group'));
    }


    public function edit(Group $group)
    {
        $users = $group->users;
        return view('group.edit', compact('group', 'users'));
    }

    public function deleteWorker(Group $group,User $user)
    {
        $group->users()->detach($user->id);
        return redirect(route('group.edit',compact('group')));
    }

    public function update(Request $request, Group $group)
    {
        $worker = $request->input('worker');
        $title = $request->input('title');
        $user = User::all()->where('name', $worker)->first();
        if (isset($user)) {
            $group->users()->attach($user->id);
            $msg = 'Пользователь успешно добавлен';
        }
            $msg = 'нет такого';
        return redirect(route('group.edit',$group->id));
    }

    public function destroy(Group $group)
    {
        $group->delete();
        return redirect(route('group.index'));
    }
}
