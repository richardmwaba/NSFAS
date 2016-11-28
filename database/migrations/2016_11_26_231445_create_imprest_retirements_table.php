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
            $table->date('dateOfReturn');
            $table->string('departedFrom');
            $table->date('departureDate');
            $table->string('arrivedAt');
            $table->integer('noOfNoNights');
            $table->integer('ratePerNight');
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
            $table->double('amountRecoverable')->default(0);
            $table->string('bursarComment')->nullable();
            $table->string('deanOrHeadComment')->nullable();
            $table->enum('bursarApproval', ['rejected','approved'])->nullable();
            $table->string('bursarManNumber')->nullable();
            $table->date('dateOfBursarApproval')->nullable();
            $table->enum('internalAuditApproval', ['rejected','approved'])->nullable();
            $table->date('dateOfInternalAuditApproval')->nullable();
            $table->enum('deanOrHeadApproval', ['rejected','approved'])->nullable();
            $table->string('deanOrHeadManNumber')->default(0);
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
