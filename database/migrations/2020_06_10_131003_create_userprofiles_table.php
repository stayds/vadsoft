<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserprofilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userprofiles', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->bigInteger('userid')->unsigned();
            $table->foreign('userid')
                ->references('id')
                ->on('users');

            $table->string('jobtitle', 100);
            $table->string('jobdesc', 150);
            $table->string('fname', 50);
            $table->string('lname', 50);
            $table->string('gender',20);
            $table->string('staffno',45);
            $table->string('gradelevel',50);
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
        Schema::dropIfExists('userprofiles');
    }
}
