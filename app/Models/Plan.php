<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'parent_id',
        'challenge_id',
        'stage_id',
        'added_by',
        'title_en',
        'title_ar',
        'status',
        'priority',
        'progress',
        'start_date',
        'end_date',
    ];

    public function childPlans(){
        return $this->hasMany(Plan::class, 'parent_id');
    }
    public function challenge(){
        return $this->belongsTo(Challenge::class);
    }
}
