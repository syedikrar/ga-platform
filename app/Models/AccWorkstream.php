<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccWorkstream extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'leader_id',
        'challenge_id',
        'uuid'
    ];

    public function members(){
        return $this->belongsToMany(User::class,'acc_workstream_user','acc_workstream_id','user_id');
    }
    public function ws_leader($leader_id){
        return User::find($leader_id);
    }
    public function tasks(){
        return $this->hasMany(Task::class);
    }
    public function countAttachments(){
        $tasks = $this->tasks->pluck('id');
        return TaskImage::whereIn('task_id',$tasks)->count();
    }
    public function taskProgress(){

        $progress = $this->tasks->pluck('progress');
        if($progress->count()){
            return array_sum($progress->toArray()) / $progress->count();
        }
        return 0;
        
    }
}
