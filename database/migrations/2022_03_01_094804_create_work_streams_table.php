<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkStreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_streams', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('mode');
            $table->string('priority');
            $table->boolean('is_existing_entity');
            $table->boolean('is_send_email');
            $table->boolean('is_send_sms');
            $table->string('status')->default('active');
            $table->unsignedBigInteger('entity_id');
            $table->unsignedBigInteger('challenge_id');
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
        Schema::dropIfExists('work_streams');
    }
}
