<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Challenge;

class ChallengeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $challenges = [
            [
                'uuid' => Str::uuid(),
                'cohort_id' => 1,
                'lead_entity_id' => 1,
                'stage_id' => 1,
                'name_en' => 'Comprehensive Citizen',
                'name_ar' => 'المواطن الشامل',
                'description_ar' => 'المواطن الشامل',
                'description_en' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est, eos dolor repellat natus autem eius? Laborum voluptatum facere impedit! Et, totam. Nisi expedita laborum quod est ullam sit rerum ipsam!',
                'baseline' => 'As described in the challenge document.',
                'status' => 'active'
            ],
            [
                'uuid' => Str::uuid(),
                'cohort_id' => 2,
                'lead_entity_id' => 3,
                'stage_id' => 1,
                'name_en' => 'Food Security',
                'name_ar' => 'أمن غذائي',
                'description_ar' => 'أمن غذائي',
                'description_en'=> 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est, eos dolor repellat natus autem eius? Laborum voluptatum facere impedit! Et, totam. Nisi expedita laborum quod est ullam sit rerum ipsam!',
                'baseline' => 'As described in the challenge document.',
                'status' => 'active'
            ],
            [
                'uuid' => Str::uuid(),
                'cohort_id' => 1,
                'lead_entity_id' => 6,
                'stage_id' => 1,
                'name_en' => 'Cyber Defense Standards',
                'name_ar' => 'معايير الدفاع السيبراني',
                'description_ar' => 'معايير الدفاع السيبراني',
                'description_en'=> 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est, eos dolor repellat natus autem eius? Laborum voluptatum facere impedit! Et, totam. Nisi expedita laborum quod est ullam sit rerum ipsam!',
                'baseline' => 'As described in the challenge document.',
                'status' => 'active'
            ],
            [
                'uuid' => Str::uuid(),
                'cohort_id' => 1,
                'lead_entity_id' => 2,
                'stage_id' => 1,
                'name_en' => 'National Parks Upgrade',
                'name_ar' => 'تطوير المنتزهات الوطنية',
                'description_ar' => 'تطوير المنتزهات الوطنية',
                'description_en'=> 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est, eos dolor repellat natus autem eius? Laborum voluptatum facere impedit! Et, totam. Nisi expedita laborum quod est ullam sit rerum ipsam!',
                'baseline' => 'As described in the challenge document.',
                'status' => 'active'
            ],
        ];

        foreach($challenges as $challenge){
            Challenge::create($challenge);
        }
    }
}
