<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Models\Group;
use App\Models\Task;
use App\Models\User;
use App\Service\Task\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends BaseController
{

    var $task_models;
    var $group_models;
    var $user;

    public function __construct()
    {
        $this->user=Auth::user();
        $this->task_models = Task::all();
        $this->group_models = Group::all();
    }

    public function index()
    {

        return view('task.index', [
            'groups' => $this->group_models,
            'tasks_left' => $this->task_models->where('worker_id',Auth::user()->id),
            'tasks_right' => $this->task_models->where('sender_id',Auth::user()->id)
        ]);
    }

    public function custom(Request $request)
    {
        $group = $request->input('group');
        $status = $request->input('status');
        $task_models_right =$this->task_models->where('sender_id',Auth::user()->id);
        $task_models_left = $this->task_models->where('worker_id',Auth::user()->id);
        if ($group) {
            $task_models_left = $this->task_models->where('group_id', $group);
        }
        if($group==='own'){
            $task_models_left=$this->task_models
                ->where('worker_id',Auth::user()->id)->where('sender_id',Auth::user()->id);
        }

        if ($status) {
            $task_models_right = $this->task_models->where('is_done', $status);
        }

        return view('task.index', [
            'groups' => $this->group_models,
            'tasks_left' => $task_models_left,
            'tasks_right' => $task_models_right,
            'group_id' => $group,
            'is_done' => $status
        ]);
    }


    public function createOwn(){
        return view('task.createOwn');
    }


    public function storeOwn(Request $request){
        $data=$request->validate([
            'title'=>'required|string|max:100',
            'content'=>'required|string',
            'date'=>'required|date'
        ]);
        $data['worker_id']=$data['sender_id']=Auth::user()->id;
        Task::create($data);
        return redirect(route('task.index'));
    }


    public function create(Group $group)
    {
        $workers = $group->users;
        return view('task.create', compact('group', 'workers'));
    }


    public function store(Request $request)
    {

        $data=$request->validate([
            'title'=>'required|string|max:100',
            'content'=>'required|string',
            'worker_id'=>'required|string',
            'date'=>'required|date'
        ]);
            $data['sender_id'] = Auth::user()->id;
            $group = Group::find($request->input('group'));
            $workers = $group->users;
            if (!isset($data['worker_id'])) {
                foreach ($workers as $item) {
                    $data['worker_id'] = $item->id;
                    Task::create($data);
                }
            } else {
                Task::create($data);
            }
            return redirect(route('group.show',$group));
        }



    public function edit(Task $task)
    {
        return view('task.edit', compact('task'));
    }

    public function update(Task $task, UpdateRequest $request)
    {
        $data = $request->validated();
        $data['group_id']=$task->group->id;
        $data['worker_id']=$task->worker_id;
        $data['sender_id']=$task->sender_id;
        $task->update($data);
        return redirect()->route('task.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('task.index');
    }

    public function editStatus(Task $task)
    {
        if(isset($task->group)) {
            $data = ['is_done' => 1];
            $task->update($data);
        return redirect()->route('task.index');
    }
        else{
            $task->delete();
            return redirect()->route('task.index');
        }
    }
}
