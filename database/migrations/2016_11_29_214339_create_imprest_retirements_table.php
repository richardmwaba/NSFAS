<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImprestRetirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('imprestRetirements', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('imprestId');
            $table->integer('chequeNo')->nullable();
            $table->date('date');
            $table->date('dateOfReturn')->nullable();
            $table->string('departedFrom')->nullable();
            $table->date('departureDate')->nullable();
            $table->string('arrivedAt')->nullable();
            $table->integer('noOfNights')->nullable();
            $table->integer('ratePerNight')->nullable();
            $table->double('subAmount')->nullable();
            $table->double('fuelAmount')->nullable();
            $table->string('item1')->nullable();
            $table->double('item1Amount')->nullable();
            $table->string('item2')->nullable();
            $table->double('item2Amount')->nullable();
            $table->string('item3')->nullable();
            $table->double('item3Amount')->nullable();
            $table->string('other')->nullable();
            $table->double('otherAmount')->nullable();
            $table->integer('receiptNumber')->nullable();
            $table->double('amountRecoverable')->default(0)->nullable();
            $table->string('bursarComment')->nullable();
            $table->string('deanOrHeadComment')->nullable();
            $table->smallInteger('bursarApproval')->default(0)->nullable();
            $table->string('bursarManNumber')->nullable();
            $table->date('dateOfBursarApproval')->nullable();
            $table->smallInteger('internalAuditApproval')->default(0)->nullable();
            $table->date('dateOfInternalAuditApproval')->nullable();
            $table->smallInteger('deanOrHeadApproval')->default(0)->nullable();
            $table->string('deanOrHeadManNumber')->nullable();
            $table->date('dateOfDeanOrHeadApproval')->nullable();
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
        //
        Schema::drop('imprestRetirements');
    }
}
