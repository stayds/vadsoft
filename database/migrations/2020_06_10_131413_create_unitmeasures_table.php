<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitmeasuresTable extends Migration
{

    public function up()
    {
        Schema::create('unitmeasures', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('unitid')->unsigned();
            $table->foreign('unitid')
                ->references('id')
                ->on('units');

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
        Schema::dropIfExists('unitmeasures');
    }
}
