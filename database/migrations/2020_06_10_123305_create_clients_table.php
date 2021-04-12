<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('sectorid')->unsigned();
            $table->foreign('sectorid')
                ->references('id')
                ->on('sectors');

            $table->bigInteger('stateid')->unsigned();
            $table->foreign('stateid')
                ->references('id')
                ->on('states');

            $table->bigInteger('licenceid')->unsigned();
            $table->foreign('licenceid')
                ->references('id')
                ->on('licences');

            $table->string('name',100);
            $table->boolean('status')->default(1);
            $table->integer('organ');
            $table->string('address',200);
            $table->date('expiry_date');

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
        Schema::dropIfExists('clients');
    }
}
