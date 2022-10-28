<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $guarded=false;
    protected $table='groups';

    public function tasks(){
        $this->hasMany(Task::class,'group_id','id');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'group_users','group_id','user_id');
    }
    public function creator(){
        return $this->belongsTo(User::class,'creator_id','id');
    }
}
