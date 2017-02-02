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

            $table->integer('incomeAcquired')->nullable();
            $table->integer('proposedBudget')->nullable();
            $table->integer('expenditureAcquired')->nullable();

            $table->integer('projects_id')->nullable();
            $table->integer('accounts_id')->nullable();
            $table->integer('budget_id')->nullable();
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
