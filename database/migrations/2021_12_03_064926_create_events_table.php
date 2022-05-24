<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->unique();
            $table->boolean('is_online')->default(0);
            $table->string('subject_en');
            $table->string('subject_ar');
            $table->string('platform')->nullable();
            $table->string('meeting_link')->nullable();
            $table->string('location_en')->nullable();
            $table->string('location_ar')->nullable();
            $table->decimal('longitude',10,8)->nullable();
            $table->decimal('latitude',10,8)->nullable();
            $table->text('agenda')->nullable();
            $table->DateTime('start_date');
            $table->DateTime('end_date')->nullable();
            $table->string('type');
            $table->string('event_on');
            $table->unsignedBigInteger('event_on_id')->comment('cohort/challenges');
            $table->string('status')->default('active');
            $table->softDeletes();
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
        Schema::dropIfExists('events');
    }
}