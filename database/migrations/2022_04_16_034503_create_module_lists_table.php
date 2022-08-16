<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('moduleId')->unsigned();
            $table->integer('parentModuleId')->unsigned();
            $table->string('moduleName',255);
            $table->string('moduleTag',255);
            $table->integer('activeStatus');
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
        Schema::dropIfExists('module_lists');
    }
}
