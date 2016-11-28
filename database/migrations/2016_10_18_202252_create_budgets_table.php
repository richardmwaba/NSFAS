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
            $table->float('netProjectBudget')->nullable();
            $table->float('departmentAmount')->nullable();
            $table->float('unzaAmount')->nullable();
            $table->float('actualProjectBudget')->nullable();

            $table->boolean('approved');
            $table->boolean('isDepartmentBudget');
            $table->string('name');

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
