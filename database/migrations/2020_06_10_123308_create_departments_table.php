<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('organisationid')->unsigned();
            $table->foreign('organisationid')
                ->references('id')
                ->on('organisations');

            $table->bigInteger('stateid')->unsigned();
            $table->foreign('stateid')
                ->references('id')
                ->on('states');

            $table->string('name',150);
            $table->text('description');
            $table->string('address',150);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('departments');
    }
}
