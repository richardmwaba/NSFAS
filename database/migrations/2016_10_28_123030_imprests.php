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
            $table->increments('imprest_id');
            $table->integer('applicant_id');
            $table->double('amount_requested');
            $table->string('purpose');
            $table->timestamps();
            $table->string('budget_line');
            $table->boolean('authorised_by_head');
            $table->boolean('authorised_by_dean');
            $table->double('authorised_amount');
            $table->timestamp('authorised_on');
            $table->boolean('isRetired')->default(false);
            $table->double('budget');
            $table->boolean('cash_available');
            $table->double('actual');
            $table->double('balance');
            $table->boolean('bursar_recommendation');

            $table->foreign('applicant_id')->references('manNumber')->on('users');
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
