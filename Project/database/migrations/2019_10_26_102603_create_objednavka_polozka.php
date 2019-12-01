<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjednavkaPolozka extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objednavka_polozka', function (Blueprint $table) {
            $table->increments('id')->unsigned(); 
            $table->integer('objednavka_id')->unsigned()->nullable();
            $table->integer('polozka_id')->unsigned()->nullable();
            $table->integer('pocet');

            $table->unique(['objednavka_id','polozka_id']);
            
            $table->timestamps();
        });
        Schema::table('objednavka_polozka', function (Blueprint $table){
            $table->foreign('objednavka_id')->references('id')->on('objednavka')->onDelete('cascade');
            $table->foreign('polozka_id')->references('id')->on('polozka')->onDelete('cascade');
        });    


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objednavka_polozka');
    }
}
