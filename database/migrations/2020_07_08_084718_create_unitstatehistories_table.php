<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitstatehistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unitstatehistories', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('unitstateid')->unsigned();
            $table->foreign('unitstateid')
                ->references('id')
                ->on('unitstates');

            $table->bigInteger('supervisorid')->unsigned();
            $table->foreign('supervisorid')
                ->references('id')
                ->on('users');

            $table->integer('labour_effy')->nullable();
            $table->integer('daily_hours_effy')->nullable();
            $table->integer('total_num_effy')->nullable();
            $table->float('achievedeff_effy')->nullable();
            $table->integer('labour_effv')->nullable();
            $table->integer('daily_hours_effv')->nullable();
            $table->integer('total_num_effv')->nullable();
            $table->float('achievedeff_effv')->nullable();
            $table->tinyInteger('approve_effy')->nullable();//[0 - entry, 1 - rejected, 2 - approved]
            $table->tinyInteger('approve_effv')->nullable();
            $table->float('kpi')->nullable();
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
        Schema::dropIfExists('unitstatehistories');
    }
}
