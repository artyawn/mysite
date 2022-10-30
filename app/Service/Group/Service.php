<?php


namespace App\Service\Group;


use App\Models\Group;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Service
{
    protected $group_models_left;
    protected $group_models_right;
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->group_models_right = $this->user->groups;
        $this->group_models_left = Group::all()->where('creator_id', $this->user->id);
    }

    public function index()
    {
        return [
            'groups_left' => $this->group_models_left,
            'groups_right' => $this->group_models_right,
        ];
    }

    public function custom($group, $worker_id)
    {
        $tasks = $group->tasks;
        $workers = $group->users;
        if ($worker_id) {
            $tasks = $tasks->where('worker_id', $worker_id);
        }
        return compact('workers', 'tasks', 'group', 'worker_id');
    }

    public function store($data)
    {
        $data['creator_id'] = $this->user->id;
        if (Group::where('creator_id', $data['creator_id'])->where('title', $data['title'])->exists()) {
            $redirect= redirect()->route('group.create')->withErrors([
                'title' => 'Вы уже создавали группу с таким названием'
            ]);
        }
        else{
            Group::create($data);
            $redirect = redirect()->route('group.index');
        }
       return $redirect;
    }

    public function updateTitle($title,$group){
        if (Group::where('creator_id', $this->user->id)->where('title', $title)->exists()) {
         redirect()->route('group.edit',compact('group'))->withErrors([
                'title' => 'Вы уже создавали группу с таким названием'
            ]);
        }
        $group->update(['title'=>$title['title']]);
    }

    public function addWorker($worker, $group)
    {

        $user = User::where('name', $worker)->first();
        if (!isset($user)) {
            return redirect(route('group.edit', $group->id))->withErrors([
                'worker' => 'Пользователя с таким именем нет']);
        }
        $group->users()->attach($user->id);
    }


}
