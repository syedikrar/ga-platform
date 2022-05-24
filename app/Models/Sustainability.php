<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sustainability extends Model
{
    use HasFactory;

    protected $fillable = [
        'challenge_id',
        'lead_entity_id',
        'lead_user_id',
    ];
}
