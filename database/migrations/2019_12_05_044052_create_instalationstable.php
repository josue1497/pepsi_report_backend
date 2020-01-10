<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstalationstable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zone', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->text('code');
            $table->timestamps();
        });

        Schema::create('instalation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date_from');
            $table->date('date_to');
            $table->integer('vc_1p')->nullable();
            $table->integer('vc_2p')->nullable();
            $table->integer('enfriador_1t')->nullable();
            $table->integer('enfriador_2t')->nullable();
            $table->integer('enfriador_3t')->nullable();
            $table->integer('passthrough')->nullable();
            $table->unsignedInteger('zone_id');
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
        Schema::dropIfExists('instalationstable');
    }
}
