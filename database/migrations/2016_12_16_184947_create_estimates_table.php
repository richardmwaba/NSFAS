<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstimatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimates', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('department_id');
            $table->integer('activities_id');

            $table->string('itemDescription');
            $table->float('pricePerUnit')->nullable();
            $table->integer('quantity');
            $table->float('cost');

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
        Schema::drop('estimates');
    }
}
