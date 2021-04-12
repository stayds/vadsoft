<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeptmeasuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deptmeasures', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('deptid')->unsigned();
            $table->foreign('deptid')
                ->references('id')
                ->on('departments');

            $table->bigInteger('organid')->unsigned();
            $table->foreign('organid')
                ->references('id')
                ->on('organisations');

            $table->bigInteger('userid')->unsigned();
            $table->foreign('userid')
                ->references('id')
                ->on('users');

            $table->bigInteger('kpiid')->unsigned();
            $table->foreign('kpiid')
                ->references('id')
                ->on('kpis');

            $table->bigInteger('assessid')->unsigned();
            $table->foreign('assessid')
                ->references('id')
                ->on('assessmenttypes');
            $table->string('routine',20);
            $table->boolean('status')->default(true);
            $table->dateTime('next_entry')->nullable();
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
        Schema::dropIfExists('deptmeasures');
    }
}
