<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('sectorid')->unsigned();
            $table->foreign('sectorid')
                ->references('id')
                ->on('sectors');

            $table->bigInteger('stateid')->unsigned();
            $table->foreign('stateid')
                ->references('id')
                ->on('states');

            $table->bigInteger('clientid')->unsigned();
            $table->foreign('clientid')
                ->references('id')
                ->on('clients');

            $table->string('name',100);
            $table->boolean('status')->default(true);
            $table->boolean('parent')->default(false);
            $table->string('address',200);
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
        Schema::dropIfExists('organisations');
    }
}
