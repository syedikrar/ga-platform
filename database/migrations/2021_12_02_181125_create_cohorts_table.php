<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCohortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cohorts', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->uuid('uuid')->unique();
            $table->foreignId('cohort_type_id')->constrained('cohort_types')->cascadeOnDelete();
            $table->integer('lead_entity_id')->nullable();
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('status')->nullable();
            $table->integer('stage_id')->nullable()->constrained('stages')->onDelete('SET NULL');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('cohorts');
    }
}
