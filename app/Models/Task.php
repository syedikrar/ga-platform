<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [

        'uuid',
        'acc_workstream_id',
        'title_en',
        'title_ar',
        'priority',
        'progress',
        'status',
        'start_date',
        'end_date',
    ];
    public function acc_work_stream(){
        return $this->belongsTo(AccWorkstream::class);
    }
    public function members(){
        return $this->belongsToMany(User::class,'task_user','task_id','user_id');
    }
    public function images(){
        return $this->hasMany(TaskImage::class);
    }
}
