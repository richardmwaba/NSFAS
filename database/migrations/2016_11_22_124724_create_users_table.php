<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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

            $table->increments('id');
            $table->integer('manNumber')->unique();

            $table->string('firstName');
            $table->string('lastName');
            $table->string('otherName');

            $table->string('email')->unique();
            $table->string('phoneNumber')->unique()->nullable();
            $table->string('password');

            $table->char('access_level_id', 2);
            $table->integer('departments_id')->default('63');
            $table->integer('schools_id')->default('11');
            $table->rememberToken();
            $table->timestamps();


            //$table->foreign('departments_id')->references('departments')->on('id')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
