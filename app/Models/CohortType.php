<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CohortType extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name_en',
        'name_ar',
        'status',
    ];

    public function cohorts(){
        return $this->hasMany(Cohort::class);
    }
}
