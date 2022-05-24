<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['uuid', 'is_online','subject_en','subject_ar','platform','meeting_link','agenda','start_date','end_date','type','event_on','event_on_id','image','location_en','location_ar','longitude','latitude'];

    public function cohort() {
        return $this->belongsTo(Cohort::class, 'event_on_id', 'id');
    }

    public function challenge() {
        return $this->belongsTo(Challenge::class, 'event_on_id', 'id');
    }
    public function images(){
        return $this->hasMany(EventImage::class);
    }
    public function invitations(){
        return $this->belongsToMany(User::class,'event_invitation','event_id','user_id');
    
    }
    public function attendance(){
        return $this->belongsToMany(User::class,'event_attendance','event_id','user_id');
    }
    public function meeting_documents(){
        return $this->hasMany(EventMeeting::class);
    }
}
