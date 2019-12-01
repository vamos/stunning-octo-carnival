<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone');
            $table->string('role')->default('užívatel');
            $table->string('city');
            $table->string('street');
            $table->integer('pracoviste_id')->unsigned()->nullable();
            // $table->rememberToken();
            $table->timestamps();
        });
        Schema::table('users', function (Blueprint $table){
            $table->foreign('pracoviste_id')->references('id')->on('provozna')->onDelete('SET NULL');
        }); 
    }
//2014_10_12_000000
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
