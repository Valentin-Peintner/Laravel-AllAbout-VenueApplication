<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenueAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id');    
            $table->foreignId('venue_id');
            $table->string('street');
            $table->string('number');
            $table->string('city');
            $table->integer('zip');
            $table->string('latitude');
            $table->string('longitude');
            
            $table->foreign('country_id')->on('countries')->references('id')->onDelete('restrict')->onUpdate('cascade');
            
            $table->foreign('venue_id')->on('venues')->references('id')->onDelete('restrict')->onUpdate('cascade');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
