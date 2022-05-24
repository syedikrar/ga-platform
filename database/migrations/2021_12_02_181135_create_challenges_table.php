<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->unique();
            $table->foreignId('cohort_id')->nullable()->constrained('cohorts')->onDelete('SET NULL');
            $table->foreignId('lead_entity_id')->nullable()->constrained('entities')->onDelete('SET NULL');
            $table->integer('stage_id')->nullable()->constrained('stages')->onDelete('SET NULL');
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('description_en');
            $table->string('description_ar');
            $table->string('status');
            $table->string('sidebar_icon')->nullable();
            $table->string('thumbnail_icon')->nullable();
            $table->string('baseline')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('challenges');
    }
}
