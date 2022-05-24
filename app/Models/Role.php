<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as Model;
class Role extends Model
{
    use HasFactory;
    protected $fillable = ['role_id', 'model_type', 'model_id', 'entityable_type', 'entityable_id '];
    public function entityable()
    {
        return $this->morphTo();
    }
}
