<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('organid')->unsigned();
            $table->foreign('organid')
                ->references('id')
                ->on('organisations');

            $table->bigInteger('deptid')->unsigned();
            $table->foreign('deptid')
                ->references('id')
                ->on('departments');

            $table->boolean('status');
            $table->string('name',100);
            $table->text('description');
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
        Schema::dropIfExists('units');
    }
}
