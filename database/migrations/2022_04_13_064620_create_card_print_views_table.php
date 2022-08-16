<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardPrintViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_print_views', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('dofId')->unsigned();
            $table->string('fishermanNameBn',55);
            $table->string('fishermanNameEn',55);
            $table->string('fathersName',55);
            $table->string('mothersName',55);
            $table->string('dateOfBirth',40);
            $table->string('gender',6);
            $table->string('nationalIdNo',17);
            $table->string('fid',16);
            $table->string('divisionId',2);
            $table->string('districtId',2);
            $table->string('upazillaId',2);
            $table->string('municipalityId',2);
            $table->string('unionId',2);
            $table->string('districtBn',100);
            $table->string('districtEn',100);
            $table->string('upazillaBn',100);
            $table->string('upazillaEn',100);
            $table->string('unionBng',100);
            $table->string('villageBng',60);
            $table->string('villageEng',60);
            $table->string('postofficeBng',60);
            $table->string('postofficeEng',60);
            $table->integer('printRejectBy');
            $table->dateTime('printRejectDate');
            $table->string('printRejectIp',15);
            $table->text('printRejectNote');
            $table->integer('printDoneBy');
            $table->dateTime('printDoneDate');
            $table->string('printDoneIp',15);
            $table->text('photoPath');
            $table->integer('statusId')->unsigned();
            $table->string('issueDate',17);
            $table->string('barcode',16);
            $table->integer('phase');
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
        Schema::dropIfExists('card_print_views');
    }
}
