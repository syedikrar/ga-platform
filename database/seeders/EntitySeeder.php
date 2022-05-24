<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Entity;

class EntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entities = [
            [
                'uuid'          => Str::uuid(),
                'name_en'       => 'Abu Dhabi Centre For Technical And Training',
                'name_ar'       => 'مركز أبوظبي للتعليم والتدريب التقني والمهني',
                'short_name'    => 'ACTVET',
                'entity_type_id'=> 1,
                'location'      => 'Abu Dhabi - United Arab Emirates',
                'latitude'      => '24.453884',
                'longitude'     => '54.3773438',
                'status'        => 'active'
            ],
            [
                'uuid'          => Str::uuid(),
                'name_en'       => 'Road AND Transportation Authority',
                'name_ar'       => 'هيئة الطرق والمواصلات',
                'short_name'    => 'RTA',
                'entity_type_id'=> 2,
                'location'      => 'Federal Transportation Authority - Abu Dhabi - United Arab Emirates',
                'latitude'      => '24.4556676',
                'longitude'     => '54.3956561',
                'status'        => 'active'
            ],
            [
                'uuid'          => Str::uuid(),
                'name_en'       => 'Abu Dhabi Health Authority',
                'name_ar'       => 'هيئة الصحة أبوظبي',
                'short_name'    => 'DoH',
                'entity_type_id'=> 1,
                'location'      => 'Health Authority - Abu Dhabi - Abu Dhabi - United Arab Emirates',
                'latitude'      => '24.3306179',
                'longitude'     => '54.61859889999999',
                'status'        => 'active'
            ],
            [
                'uuid'          => Str::uuid(),
                'name_en'       => 'Dubai Airports',
                'name_ar'       => 'مطارات دبي',
                'short_name'    => 'DA',
                'entity_type_id'=> 2,
                'location'      => 'Dubai Airports - Dubai - United Arab Emirates',
                'latitude'      => '25.2630312',
                'longitude'     => '55.3379738',
                'status'        => 'active'
            ],
            [
                'uuid'          => Str::uuid(),
                'name_en'       => 'Emirates Islamic',
                'name_ar'       => 'الإمارات الإسلامي',
                'short_name'    => 'EI',
                'entity_type_id'=> 2,
                'location'      => 'Emirates Islamic - Abu Dhabi - United Arab Emirates',
                'latitude'      => '24.4957802',
                'longitude'     => '54.3836905',
                'status'        => 'active'
            ],
            [
                'uuid'          => Str::uuid(),
                'name_en'       => 'Ministry OF Industry & Advanced Technologies',
                'name_ar'       => 'وزارة الصناعة والتكنولوجيات المتقدمة',
                'short_name'    => 'MoIAT',
                'entity_type_id'=> 1,
                'location'      => 'Ministry of industry and Advanced Technology - Al Ittihad Road - Dubai - United Arab Emirates',
                'latitude'      => '25.2584364',
                'longitude'     => '55.3364485',
                'status'        => 'active'
            ],
        ]; 
        

        foreach($entities as $entity){
            Entity::create($entity);
        }
    
    }
}
