<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Touchpoint extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'title_en',
        'title_ar',
        'subtitle_en',
        'subtitle_ar',
        'default_image',
        'done_image',
        'is_completed',
        'is_send_update',
        'status',
        'cohort_id',
        'is_active'
    ];
    public function cohort(){
        return $this->belongsTo(Cohort::class);
    }
}
