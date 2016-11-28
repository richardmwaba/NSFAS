<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalculatedTotalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculated_totals', function (Blueprint $table) {
            $table->increments('id');

            $table->float('incomeAcquired')->nullable();
            $table->float('proposedBudget')->nullable();

            $table->integer('projects_id');
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
        Schema::drop('calculated_totals');
    }
}
