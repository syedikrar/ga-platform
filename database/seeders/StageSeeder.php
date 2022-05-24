<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Stage;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stages = [
            [
                'uuid'    => Str::uuid(),
                'name_en' => 'Acceleration',
                'name_ar' => 'التسريع',
                'status'  =>'active', 
            ],
            [
                'uuid'    => Str::uuid(),
                'name_en' => 'Sustainability',
                'name_ar' => 'الاستدامة',
                'status'  =>'active', 
            ]
            ,
            [
                'uuid'    => Str::uuid(),
                'name_en' => 'Scalability',
                'name_ar' => 'قابلية التوسع',
                'status'  =>'active', 
            ]
        ];

        foreach($stages as $stage){
            Stage::create($stage);
        }
    }
}
