<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Cohort;

class CohortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cohorts = [
            [
                'uuid' => Str::uuid(),
                'name_en' => 'GA Diploma - Cohort 1',
                'name_ar' => 'شهادة دبلوم',
                'cohort_type_id'  => 1,
                'lead_entity_id' => 1,
                'status' => 'ongoing',
                'stage_id' => 1,
                'start_date' => '2022-12-2',
                'end_date' => '2022-12-10',
            ],
            [
                'uuid' => Str::uuid(),
                'name_en' => 'Food Security',
                'name_ar' => 'أمن غذائي',
                'cohort_type_id'  => 1,
                'lead_entity_id' => 1,
                'status' => 'ongoing',
                'stage_id' => 1,
                'start_date' => '2022-12-2',
                'end_date' => '2022-12-10',
            ],
            [
                'uuid' => Str::uuid(),
                'name_en' => 'Gov Services Cohort',
                'name_ar' => 'مجموعة الخدمات الحكومية',
                'cohort_type_id'  => 1,
                'lead_entity_id' => 1,
                'status' => 'ongoing',
                'stage_id' => 1,
                'start_date' => '2022-12-2',
                'end_date' => '2022-12-10',
            ],
            [
                'uuid' => Str::uuid(),
                'name_en' => 'Citizenship Criteria',
                'name_ar' => 'معايير الجنسية',
                'cohort_type_id'  => 1,
                'lead_entity_id' => 1,
                'status' => 'ongoing',
                'stage_id' => 1,
                'start_date' => '2022-12-2',
                'end_date' => '2022-12-10',
            ],
            [
                'uuid' => Str::uuid(),
                'name_en' => 'Enhancing Local Identity In Urban Planning & Architecture',
                'name_ar' => 'تعزيز الهوية المحلية في التخطيط العمراني والعمارة',
                'cohort_type_id'  => 1,
                'lead_entity_id' => 1,
                'status' => 'ongoing',
                'stage_id' => 1,
                'start_date' => '2022-12-2',
                'end_date' => '2022-12-10',
            ],
        ];

        foreach($cohorts as $cohort){
            Cohort::create($cohort);
        }
    }
}
