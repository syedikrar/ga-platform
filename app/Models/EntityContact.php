<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityContact extends Model
{
    use HasFactory;


    protected $fillable = [
        'uuid',
        'entity_id',
        'title',
        'name_en',
        'name_ar',
        'avatar',
        'email',
        'designation_en',
        'designation_ar',
        'phone_number',
        'mobile_number',
        'remarks'
    ];
}
