<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Risk extends Model
{
    use HasFactory;

    protected $fillable = [
            'uuid',
            'challenge_id',
            'stage_id',
            'added_by',
            'title_en',
            'title_ar',
            'description_en',
            'description_ar',
            'mitigation_plan_file',
            'mitigation_plan_en',
            'mitigation_plan_ar',
            'impact',
            'probability',
            'identification_date',
            'status'
    ];
}
