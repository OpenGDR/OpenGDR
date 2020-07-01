<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('races', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_plural')->nullable();
            $table->string('name_male')->nullable();
            $table->string('name_female')->nullable();
            $table->boolean('active')->default(false);
            $table->boolean('avaible_registration')->default(false);
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->string('url')->nullable();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('races');
    }
}
