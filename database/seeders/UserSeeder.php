<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'uuid' => Str::uuid(),
            'name_ar' => 'Super Admin',
            'name_en' => 'Super Admin',
            'email' => 'admin@accelerators.gov.ae',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('12#$56&*990'),
            'email' => 'admin@accelerators.gov.ae',
            'status' => 'active'
        ]);
    }
}
