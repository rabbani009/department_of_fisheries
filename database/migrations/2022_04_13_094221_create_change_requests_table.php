<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangeRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_requests', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('dofId')->unsigned();
            $table->text('claimNote');
            $table->integer('claimBy');
            $table->dateTime('claimDate');
            $table->string('claimIp',15);
            $table->integer('solvedBy')->unsigned();
            $table->dateTime('solvedDate')->nullable();
            $table->string('solvedIp',15);
            $table->integer('sloveStatus');
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
        Schema::dropIfExists('change_requests');
    }
}
