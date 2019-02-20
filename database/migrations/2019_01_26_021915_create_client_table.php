<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('client', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',120);
            $table->string('rfc',20);
            $table->string('phone1',15);
            $table->string('phone2',15)->nullable();
            $table->string('extras',1000)->nullable();
            $table->string('email',250);
            $table->string('datenum',250);
            $table->string('col',250);
            $table->string('postal_code',250);
        //    $table->string('birth')->nullable();
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
        Schema::dropIfExists('client');
    }
}
