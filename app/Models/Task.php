<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded=false;
    protected $table='tasks';

    public function group(){
        return $this->belongsTo(Group::class,'group_id','id');
    }

    public function sender(){
        return $this->belongsTo(User::class,'sender_id','id');
    }

    public function  worker(){
        return $this->belongsTo(User::class,'worker_id','id');
    }
}
