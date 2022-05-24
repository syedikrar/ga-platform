<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name_en',
        'name_ar',
        'cohort_type_id',
        'lead_entity_id',
        'status',
        'stage_id',
        'start_date',
        'end_date',
        'is_active',
    ];

    public function cohortType(){
        return $this->belongsTo(CohortType::class);
    }

    public function challenges(){
        return $this->hasMany(Challenge::class);
    }
    public function stage(){
        return $this->belongsTo(Stage::class);
    }
    public function touchpoints(){
        return $this->hasMany(Touchpoint::class);
    }
}
