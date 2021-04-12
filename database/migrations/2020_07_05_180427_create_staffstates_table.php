<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffstates', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('measureid')->unsigned();
            $table->foreign('measureid')
                ->references('id')
                ->on('staffmeasures');

//            $table->text('description');
            $table->text('question_effy')->nullable();
            $table->integer('expected_hour_effy')->nullable();
            $table->float('expected_effy')->nullable();
            $table->text('question_effv')->nullable();
            $table->integer('expected_hour_effv')->nullable();
            $table->float('expected_effv')->nullable();

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
        Schema::dropIfExists('staffstates');
    }
}
