<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {

            $table->increments('id');

            $table->string('budgetName')->nullable();
            $table->decimal('schoolIncome', 12, 2)->nullable();
            $table->decimal('departmentIncome', 12, 2)->nullable();
            $table->decimal('netProjectBudget', 12, 2)->nullable();
            $table->decimal('departmentAmount', 12, 2)->nullable();
            $table->decimal('unzaAmount', 12, 2)->nullable();
            $table->decimal('actualProjectBudget', 12, 2)->nullable();

            $table->boolean('approved');
            $table->boolean('isDepartmentBudget');

            $table->integer('projects_id')->nullable();
            $table->integer('departments_id')->nullable();
            $table->integer('accounts_id')->nullable();
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
        Schema::drop('budgets');
    }
}
