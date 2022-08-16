<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_offices', function (Blueprint $table) {
            $table->id();
            $table->integer('postId');
            $table->integer('divisionId');
            $table->integer('districtId');
            $table->integer('upazillaId');
            $table->integer('municipalityId');
            $table->integer('unionId');
            $table->string('postOfficeEnglish');
            $table->string('postOfficeBangla');
            $table->string('dataEntryBy');
            $table->datetime('dataEntryDate');
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
        Schema::dropIfExists('post_offices');
    }
}
