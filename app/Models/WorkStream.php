<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkStream extends Model
{
    use HasFactory;
    protected $fillable = [
        'mode',
        'name_en',
        'name_ar',
        'priority',
        'is_existing_entity',
        'is_send_email',
        'is_send_sms',
        'status',
        'entity_id',
        'challenge_id'
    ];

    public function entity()
    {
        return $this->hasOne(Entity::class);
    }
    
    public function challenge(){
        return $this->belongTo(Challenge::class);
    }
}
