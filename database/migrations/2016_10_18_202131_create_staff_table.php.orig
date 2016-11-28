<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('manNumber')->unique();

            $table->string('firstName');
            $table->string('lastName');
            $table->string('otherName');
            $table->string('phoneNumber');

            $table->integer('departments_id');
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
        Schema::drop('staff');
    }
}
