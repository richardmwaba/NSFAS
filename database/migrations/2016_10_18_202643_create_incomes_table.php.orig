<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {

            $table->increments('id');
            $table->float('amountReceived');
            $table->string('giver');
            $table->string('receiptNumber');
<<<<<<< HEAD
            $table->integer('account_id');
=======

            $table->integer('accounts_id');
>>>>>>> 09ca028c1b12c5b2f598c2f3ad5b91b05716ce05
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
        Schema::drop('incomes');
    }
}
