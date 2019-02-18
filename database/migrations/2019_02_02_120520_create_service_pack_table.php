<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicePackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_pack', function (Blueprint $table) {
            $table->unsignedInteger('contrato_id');
            $table->unsignedInteger('services_id');
            $table->unsignedInteger('count');
            $table->timestamps();

            $table->foreign('contrato_id')->references('id')->on('contrato');
            $table->foreign('services_id')->references('id')->on('services');

        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('service_pack', function (Blueprint $table) {
            $table->dropForeign('services_id');
            $table->dropForeign('services_id');
     });
        Schema::dropIfExists('service_pack');
    }
}

