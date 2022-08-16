<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardReprintLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_reprint_logs', function (Blueprint $table) {
            $table->id();
            $table->string('fid',16);
            $table->text('reprintRemark');
            $table->string('reprintBy',50);
            $table->dateTime('reprintDateTime');
            $table->string('reprintIp',16);
            $table->string('issueDate',17);
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
        Schema::dropIfExists('card_reprint_logs');
    }
}
