<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicenseesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licensees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('emirate_id');
            $table->date('dob');
            $table->integer('status');
            $table->string('area');
            $table->text('remarks')->nullable();
            $table->unsignedInteger('inspector_id')->nullable();
            $table->boolean('requirement_1');
            $table->boolean('requirement_2');
            $table->boolean('requirement_3');
            $table->timestamps();
            $table->foreign('inspector_id')->references('id')->on('inspectors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('licensees');
    }
}
