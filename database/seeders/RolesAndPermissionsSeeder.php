<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'cohort_permissions'    => ['view cohort','edit cohort','delete cohort','add cohort'],
            'challenge_permissions' => ['view challenge','edit challenge','delete challenge','add challenge'],
            'user_permissions'      => ['view users','edit users','delete users','add users','change password','edit payment info'],
            'settings_permissions'  => ['view settings','edit settings'],
        ];

            foreach($permissions as $items){
                foreach($items as $permission){
                    Permission::create(['name' => $permission]);
                }
            }
            
            $adminRole                    = Role::create(['name' => 'admin', 'type' => 'system_user']);
            $staffRole                    = Role::create(['name' => 'staff', 'type' => 'system_user']);
            $systemUsercoachRole          = Role::create(['name' => 'coach', 'type' => 'system_user']);
            $systemUserleadershipRole     = Role::create(['name' => 'leadership', 'type' => 'system_user']);
            $systemUsersponsorRole        = Role::create(['name' => 'sponsor', 'type' => 'system_user']);
            $entityUserRole               = Role::create(['name' => 'entity user', 'type' => 'entity_user']);
            $entityLeaderRole             = Role::create(['name' => 'entity leader', 'type' => 'entity_user']);
            $teamLeaderRole               = Role::create(['name' => 'team leader', 'type' => 'challenge_user']);
            $teamMemberRole               = Role::create(['name' => 'team member', 'type' => 'challenge_user']);
            $challengeUsercoachRole       = Role::create(['name' => 'challenge_coach', 'type' => 'challenge_user']);
            $challengeUserleadershipRole  = Role::create(['name' => 'chalenge_leadership', 'type' => 'challenge_user']);
            $challengeUsersponsorRole     = Role::create(['name' => 'challenge_sponsor', 'type' => 'challenge_user']);
            $hiddenSoldierRole            = Role::create(['name' => 'hidden soldier', 'type' => 'challenge_user']);
           

            $adminRole->givePermissionTo($permissions['cohort_permissions'], 
                $permissions['challenge_permissions'],
                $permissions['user_permissions'], 
                $permissions['settings_permissions']
            );  
    }
}
