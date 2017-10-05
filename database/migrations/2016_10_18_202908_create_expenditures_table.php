<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpendituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenditures', function (Blueprint $table) {

            $table->increments('id');

            $table->decimal('amountPaid', 12, 2);
            $table->string('budgetLine')->nullable();
            $table->string('beneficiary');
            $table->string('purpose');
            $table->string('voucherNumber')->nullable();
            $table->string('datePaid');
            $table->boolean('approved');
            $table->boolean('approvedByHOD');
            $table->boolean('approvedByACC');
            $table->boolean('approvedByDN');

            $table->integer('accounts_id');
            $table->integer('projects_id')->nullable();
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
        Schema::drop('expenditures');
    }
}
