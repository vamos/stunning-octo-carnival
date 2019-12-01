<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNabidkaPolozka extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nabidka_polozka', function (Blueprint $table) {
            $table->increments('alternative_id')->unsigned(); 
            $table->integer('nabidka_id')->unsigned()->nullable();
            $table->integer('polozka_id')->unsigned()->nullable();
            $table->string('typ')->nullable()->default('Trvalý');
            // $table->foreign('nabidka_id')->references('id')->on('nabidka');
            // $table->foreign('polozka_id')->references('id')->on('polozka');

            $table->unique(['nabidka_id','polozka_id']);
            
            $table->timestamps();
        });
        Schema::table('nabidka_polozka', function (Blueprint $table){
            $table->foreign('nabidka_id')->references('id')->on('nabidka')->onDelete('cascade');
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
        Schema::dropIfExists('nabidka_polozka');
    }
}
