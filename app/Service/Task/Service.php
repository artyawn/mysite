<?php


namespace App\Service\Task;


use App\Models\Group;
use App\Models\Task;

class Service
{


    public function store($data)
    {
        Task::create($data);
    }

    public function update()
    {
    }

    public function create()
    {

    }
    public function custom(){
    }
}
