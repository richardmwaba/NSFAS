<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImprestsTable extends Migration
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
            $table->integer('applicantId')->nullable();
            $table->integer('departmentId');
            $table->double('amountRequested');
            $table->integer('purpose')->nullable();
            $table->integer('budgetLine')->nullable();
            $table->integer('authorisedByHead')->default(0);
            $table->date('authorisedByHeadOn');
            $table->integer('headManNumber')->nullable();
            $table->string('commentFromHead')->nullable();
            $table->integer('authorisedByDean')->default(0);
            $table->date('authorisedByDeanOn');
            $table->integer('deanManNumber')->nullable();
            $table->string('commentFromDean')->nullable();
            $table->integer('bursarRecommendation')->default(0);
            $table->date('bursarRecommendationDate')->nullable();
            $table->integer('bursarManNumber')->nullable();
            $table->string('commentFromBursar')->nullable(false);
            $table->double('authorisedAmount')->default(0);
            $table->double('imprestBalance')->default(0);
            $table->boolean('cashAvailable')->default(false);
            $table->date('dateOutstandingImprest')->nullable();
            $table->boolean('isRetired')->default(false);
            $table->boolean('overDue')->default(false);
            $table->boolean('seenByDean')->default(false);
            $table->timestamps();


            $table->foreign('applicantId')->references('manNumber')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('HeadManNumber')->references('manNumber')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('DeanManNumber')->references('manNumber')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('bursarManNumber')->references('manNumber')->on('users')->onDelete('set null')->onUpdate('cascade');
            //$table->foreign('budgetLine')->references('id')->on('budgets')->onDelete('set null')->onUpdate('cascade');
            //$table->foreign('purpose')->references('id')->on('budgetItems')->onDelete('set null')->onUpdate('cascade');
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
        Schema::drop('imprests');
    }
}
