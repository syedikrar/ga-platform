<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->uuid('uuid')->unique();
            $table->integer('challenge_id')->nullable()->constrained('challenges')->onDelete('SET NULL');
            $table->integer('parent_id')->nullable()->constrained('challenges')->onDelete('SET NULL');
            $table->integer('stage_id')->nullable()->constrained('stages')->onDelete('SET NULL');
            $table->integer('added_by')->nullable();
            $table->string('title_en');
            $table->string('title_ar');
            $table->enum('priority',['Low','Medium','Urgent']);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
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
        Schema::dropIfExists('plans');
    }
}
