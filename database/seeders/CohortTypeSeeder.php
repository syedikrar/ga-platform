<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\CohortType;

class CohortTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cohortTypes = [
            [
                'uuid'    => Str::uuid(),
                'name_en' => 'Development',
                'name_ar' => 'تطوير',
                'status'  =>'active', 
            ]
        ];

        foreach($cohortTypes as $type){
            CohortType::create($type);
        }
    }
}
