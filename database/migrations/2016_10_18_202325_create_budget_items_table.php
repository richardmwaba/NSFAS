<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_items', function (Blueprint $table) {

            $table->increments('id');

            $table->string('budgetLine');
            $table->string('description');
            $table->integer('quantity');
            $table->float('pricePerUnit');
            $table->float('cost');

            $table->integer('budget_id');
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
        Schema::drop('budget_items');
    }
}
