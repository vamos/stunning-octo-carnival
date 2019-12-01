<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolozkaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polozka', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            // $table->string('druh',100);
            $table->string('typ',100);
            $table->string('popis',200);
            $table->string('obrazok')->default('placeholder.png');
            $table->float('cena')->unsigned();
            $table->string('kategoria',100);
            // $table->string('denny_trvaly',200);
            $table->float('objem');
            $table->integer('hmotnost');
            $table->float('alkohol');


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
        Schema::dropIfExists('polozka');
    }
}
