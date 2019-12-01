<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjednavkaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objednavka', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provozna_id')->unsigned()->nullable();
            $table->integer('uzivatel_id')->unsigned()->nullable();
            $table->integer('operator_id')->unsigned()->nullable();
            $table->integer('vodic_id')->unsigned()->nullable();
            $table->string('meno',100)->nullable();
            $table->string('mesto',100)->nullable();
            $table->string('ulica',100)->nullable();
            $table->string('tel',100)->nullable();
            $table->string('email',100)->nullable();
            $table->string('stav',100)->nullable()->default('Nevyřízená');

            //asi staci pre ulozenie "Čas", pri vkladani by bola iba updatovana
            //$today = new DateTime('now');
            //created_at'         => $today->format('Y-m-d H:i:s'),
            //'updated_at'         => $today->format('Y-m-d H:i:s'),
            $table->timestamps();
        });
        Schema::table('objednavka', function (Blueprint $table){
            $table->foreign('provozna_id')->references('id')->on('provozna')->onDelete('cascade');
            $table->foreign('uzivatel_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('operator_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('vodic_id')->references('id')->on('users')->onDelete('SET NULL');
        });


        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objednavka');
    }
}
