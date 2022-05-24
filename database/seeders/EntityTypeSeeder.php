<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\EntityType;

class EntityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entityTypes = [
            [
                'uuid'    => Str::uuid(),
                'name_en' => 'Abu Dhabi Government',
                'name_ar' => 'حكومة أبوظبي',
                'status'  => 'active',
                'sector'  => 'Government'
            ],
            [
                'uuid'    => Str::uuid(),
                'name_en' => 'Dubai Government',
                'name_ar' => 'حكومة دبي',
                'status'  => 'active',
                'sector'  => 'Private Sector'

            ]
        ];
        foreach($entityTypes as $entityType){
            EntityType::create($entityType);
        }
        
    }
}
