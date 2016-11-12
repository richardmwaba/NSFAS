<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Imprests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('imprests', function (Blueprint $table) {
            $table->increments('imprestId');
            $table->integer('applicantId');
            $table->integer('departmentId');
            $table->double('amountRequested');
            $table->integer('purpose');
            $table->integer('budgetLine')->nullable();
            $table->boolean('authorisedByHead')->default(false);
            $table->string('commentFromHead')->nullable();
            $table->boolean('authorisedByDean')->default(false);
            $table->string('commentFromDean')->nullable();
            $table->boolean('bursarRecommendation')->default(false);
            $table->string('commentFromBursar')->nullable(false);
            $table->double('authorisedAmount')->default(0);
            $table->double('imprestBalance')->default(0);
            $table->double('actualAmountCollected')->default(0);
            $table->timestamp('authorisedOn')->nullable();
            $table->boolean('cashAvailable')->default(false);
            $table->date('dateOutstandingImprest')->nullable();
            $table->boolean('isRetired')->default(false);
            $table->boolean('seenByDean')->default(false);
            $table->timestamps();


            $table->foreign('applicantId')->references('manNumber')->on('users');
            //$table->foreign('budgetLine')->references('id')->on('budgets');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
