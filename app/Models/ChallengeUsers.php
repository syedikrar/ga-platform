<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChallengeUsers extends Model
{
    use HasFactory;
    protected $table = 'challenge_user';
    protected $fillable = [
        'challenge_id',
        'user_id'      
    ];

    public function challenges()
    {
        return $this->hasMany(Challenge::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
