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
            $table->decimal('pricePerUnit', 12, 2)->nullable();
            $table->integer('quantity');
            $table->decimal('cost', 12, 2);

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
