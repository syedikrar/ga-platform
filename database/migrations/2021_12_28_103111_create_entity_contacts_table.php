<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntityContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_contacts', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->uuid('uuid')->unique();
            $table->foreignId('entity_id')->nullable()->constrained('entities')->onDelete('SET NULL');
            $table->enum('title', ['Mr.', 'Mrs.', 'Ms.'])->default('Mr.');
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('avatar')->nullable();
            $table->string('email')->nullable();
            $table->string('designation_en')->nullable();;
            $table->string('designation_ar')->nullable();;
            $table->string('phone_number')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('remarks')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('entity_contacts');
    }
}
