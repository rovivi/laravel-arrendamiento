<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrato', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id');
            $table->string('name');
            $table->integer('people_food');
            $table->integer('people_event');
            $table->decimal('price_total',10,2);
            $table->decimal('deposit',10,2);
            $table->string('date_range_start');    
            $table->string('date_range_end');    
            $table->string('time_food');
            $table->integer('discount_food');
            $table->integer('discount_event');

            //$table->unsignedInteger('id_client');
            $table->foreign('client_id')->references('id')->on('client');

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
        Schema::table('contrato', function (Blueprint $table) {
            $table->dropForeign('client_id');
     });
        Schema::dropIfExists('contrato');
    }
}
