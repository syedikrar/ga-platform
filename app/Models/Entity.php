<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
class Entity extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'logo',
        'name_en',
        'name_ar',
        'short_name',
        'entity_type_id',
        'website',
        'email',
        'phone',
        'fax',
        'address_en',
        'address_ar',
        'latitude',
        'longitude',
        'location',
        'status',
    ];

    public function entityType(){
        return $this->belongsTo(EntityType::class);
    }

    public function challenges(){
        return $this->hasMany(Challenge::class, 'lead_entity_id');
    }
    public function users(){
        return $this->hasMany(User::class);
    }
    public function work_stream(){
        return $this->belongsTo(WorkStream::class);
    }
    public function entities(){
        return $this->morphMany(Role::class, 'entityable')->withPivot('entityable_type', 'entityable_id');
    }
}
