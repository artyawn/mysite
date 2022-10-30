<?php


namespace App\Service\Task;


use App\Models\Group;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class Service
{
    protected $user;
    protected $task_models_right;
    protected $task_models_left;
    protected $group_models;


    public function __construct()
    {
        $this->user = Auth::user();
        $this->task_models_right = $this->user->tasksSender;
        $this->task_models_left = $this->user->tasksWorker;
        $this->group_models = $this->user->groups;
    }

    public function index()
    {
       foreach ($this->task_models_right as $task){
           if($task->worker_id==$this->user->id){
               continue;
           }
               $task_models_right[]=$task;

       }
        $data = [
            'groups' => $this->user->groups,
            'tasks_left' => $this->task_models_left,
            'tasks_right' => $task_models_right
        ];
        return $data;
    }

    public function store($data)
    {
        $group = Group::find($data['group_id']);
        $data['sender_id'] = Auth::user()->id;
        $workers = $group->users;
        if (!isset($data['worker_id'])) {
            foreach ($workers as $item) {
                $data['worker_id'] = $item->id;
                Task::create($data);
            }
        }
        else {
            Task::create($data);
        }
    }

    public function update($data, $task)
    {
        $data['group_id'] = $task->group->id;
        $data['worker_id'] = $task->worker_id;
        $data['sender_id'] = $task->sender_id;
        $task->update($data);
    }


    public function custom($group, $status)
    {
        $task_models_left= $this->task_models_left;
        $task_models_right= $this->task_models_right;
        if ($group) {
            $task_models_left = $this->task_models_left->where('group_id',$group)  ;
        }
        if ($group === 'own') {
            $task_models_left = $this->task_models_left
                ->where('sender_id', $this->user->id);
        }

        if ($status) {
            $task_models_right = $this->task_models_right->where('is_done', $status);
        }
        return [
            'groups' => $this->group_models,
            'tasks_left' => $task_models_left,
            'tasks_right' => $task_models_right,
            'group_id' => $group,
            'is_done' => $status
        ];

    }


    public function storeOwn($data)
    {
        $data['worker_id'] = $data['sender_id'] = Auth::user()->id;
        Task::create($data);
    }


    public function editStatus($task)
    {
        if (isset($task->group)) {
            $data = ['is_done' => 1];
            $task->update($data);
        } else {
            $task->delete();
        }
    }
}
