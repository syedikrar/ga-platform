<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccWorkstreamUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acc_workstream_user', function (Blueprint $table) {
            $table->unsignedBigInteger('acc_workstream_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('acc_workstream_id')->references('id')->on('acc_workstreams')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ac_workstream_user', function (Blueprint $table) {
            //
        });
    }
}
