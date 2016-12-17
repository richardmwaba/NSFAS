<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('objectives_id');

            $table->string('activityName');
            $table->string('indicatorOfSuccess');
            $table->string('targetOfIndicator');
            $table->string('baselineOfIndicator');
            $table->string('sourceOfFunding');
            $table->string('staffResponsible');
            $table->string('percentageAchieved');
            $table->boolean('firstQuarter');
            $table->boolean('secondQuarter');
            $table->boolean('thirdQuarter');
            $table->boolean('fourthQuarter');

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
        Schema::drop('activities');
    }
}
