<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChallengeUser extends Model
{
    use HasFactory;

    protected $table = 'challenge_user';

    protected $fillable = [
        'challenge_id',
        'user_id',
    ];

     public function challenge(){
        return $this->belongsTo(Challenge::class);
    }

    public function users(){
        return $this->hasMany(User::class,'id','user_id');
    }

     public function entiity(){
        return $this->belongsTo(Entity::class);
    }


}
