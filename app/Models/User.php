<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\PermissionRegistrar;
use DB;
use App\Notifications\ResetPasswordNotification;
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'entity_id',
        'first_name',
        'last_name',
        'name_en',
        'name_ar',
        'email',
        'phone',
        'password',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function challenges()
    {
        return $this->belongsToMany(Challenge::class);
    }

    public function workStreams()
    {
        return $this->hasMany(WorkStream::class);
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }

    public function experiences()
    {
        return $this->hasMany(UserExperience::class);
    }

    public function storeUserRoles($role, $userId, $entityClass, $entity){
        
        $insert = DB::table('model_has_roles')->insert(
            array('role_id' => $role,
                  'model_type' => 'App\Models\User',
                  'model_id' => $userId,
                  'entityable_type' => $entityClass,
                  'entityable_id' => $entity)
        );
        
        return $insert;
    }

    public function updateUserRole($roleName, $user, $entityModel, $entity){
        
        $roleFound = Role::where('name', $roleName)->first();
        $checkRole = DB::table('model_has_roles')->where(['role_id' => $roleFound->id, 'model_id' => $user->id, 'entityable_type' => $entityModel, 'entityable_id' => $entity])->get();
        
        if($entityModel == 'Challenge'){
            $roleTeamLeader = Role::where('name', 'team leader')->first();
            $roleTeamMember = Role::where('name', 'team member')->first();
            $roleReplaceWith = $roleFound->name == 'team leader' ? $roleTeamMember->id : $roleTeamLeader->id;
            
            if($checkRole->count() > 0){
                $roleUpdated = DB::table('model_has_roles')
                    ->where('role_id', $checkRole[0]->role_id)
                    ->where('entityable_type', $entityModel)
                    ->where('entityable_id', $entity)  
                    ->limit(1)  // optional - to ensure only one record is updated.
                    ->update(array('role_id' => $roleReplaceWith));
               
                return $roleUpdated;
            }
        }
        //when user has no entry in model_has_role table
        if($user->roles->count() == 0){
            $insert = DB::table('model_has_roles')->insert(
                array('role_id' => $roleFound->id,
                      'model_type' => 'App\Models\User',
                      'model_id' => $user->id,
                      'entityable_type' => $entityModel,
                      'entityable_id' => $entity->id)
            );
            return $insert;
        }
        //if record already exists return false
        if($checkRole->count() > 0){
            return false;
        }else{
            foreach($user->roles as $role){
                $userRole = DB::table('model_has_roles')->where(['role_id' => $role->id, 'model_id' => $user->id, 'entityable_type' => $entityModel, 'entityable_id' => $entity->id])->first();
                
                if($userRole && $userRole->role_id != $roleFound->id){
                    $roleDeleted = DB::table('model_has_roles')->where(['role_id' => $userRole->role_id, 'model_id' => $user->id, 'entityable_type' => $entityModel, 'entityable_id' => $entity->id])->delete();
                    
                    if($roleDeleted){
                        $insert = DB::table('model_has_roles')->insert(
                            array('role_id' => $roleFound->id,
                                  'model_type' => 'App\Models\User',
                                  'model_id' => $user->id,
                                  'entityable_type' => $entityModel,
                                  'entityable_id' => $entity->id)
                        );
                        
                        return $insert;
                    }
                }
            }
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}

