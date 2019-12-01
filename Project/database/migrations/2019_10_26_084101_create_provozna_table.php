<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvoznaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provozna', function (Blueprint $table) {
        $table->increments('id');
        $table->timestamps();
        $table->integer('nabidka_id')->unsigned()->nullable();
        // $table->foreign('nabidka_id')->references('id')->on('nabidka');
        $table->string('oznaceni',100);
        $table->string('obrazok')->default('placeholder.png');
        $table->string('adresa',100);
        $table->integer('od');
        $table->integer('do');
        $table->integer('uzaverka');
        $table->integer('max_den_poloz');

        });
        Schema::table('provozna', function (Blueprint $table){
             $table->foreign('nabidka_id')->references('id')->on('nabidka')->onDelete('SET NULL');
        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provozna');
    }
}
