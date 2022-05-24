<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRisksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('risks', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->uuid('uuid')->unique();
            $table->integer('challenge_id')->nullable()->constrained('challenges')->onDelete('SET NULL');
            $table->integer('stage_id')->nullable()->constrained('stages')->onDelete('SET NULL');
            $table->integer('added_by')->nullable();
            $table->string('title_en');
            $table->string('title_ar');
            $table->string('description_en')->nullable();
            $table->string('description_ar')->nullable();
            $table->string('mitigation_plan_file')->nullable();
            $table->string('mitigation_plan_en')->nullable();
            $table->string('mitigation_plan_ar')->nullable();
            $table->enum('impact',['Low','Medium','High','Very High']);
            $table->enum('probability',['Likely','Certain']);
            $table->date('identification_date');
            $table->string('status');
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
        Schema::dropIfExists('risks');
    }
}
