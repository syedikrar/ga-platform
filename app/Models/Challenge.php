<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
class Challenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'cohort_id',
        'lead_entity_id',
        'stage_id',
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'baseline',
        'goal',
        'status',
        'thumbnail_icon',
        'sidebar_icon'
    ];

    public function leadEntity(){
        return $this->belongsTo(Entity::class);
    }
    public function cohort(){
        return $this->belongsTo(Cohort::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function work_stream() {
        return $this->hasMany(WorkStream::class);
    }
    public function acc_work_stream() {
        return $this->hasMany(AccWorkstream::class);
    }
    public function cohort_touchpoints() {
        return $this->cohort->touchpoints()->orderBy('id','asc');
    }
    public function secondary_entities(){
        return $this->belongsToMany(Entity::class,'challenge_entity','challenge_id','entity_id');
    
    }
        public function entities() {
        return $this->morphMany(Role::class, 'entityable');
    }
}
