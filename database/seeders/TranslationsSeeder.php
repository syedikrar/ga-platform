<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\TranslationLoader\LanguageLine;
use Illuminate\Support\Facades\Schema;


class TranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('language_lines')->truncate();
        Schema::enableForeignKeyConstraints();

        $translations = [];

        // Menu
        include 'includes/TranslationsMenuSeeder.php';

        try {
            DB::beginTransaction();
            LanguageLine::insert($translations);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }
}
