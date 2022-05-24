<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityType extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name_en',
        'name_ar',
        'sector',
        'status',
    ];

    public function entities(){
        return $this->hasMany(Entity::class);
    }
}
