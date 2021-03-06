<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStandalonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standalones', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('name');
          $table->text('description');
          $table->unsignedInteger('bedrooms');
          $table->unsignedInteger('bathrooms');
          $table->unsignedInteger('parking_slots');
          $table->string('plot_size');
          $table->unsignedInteger('area');
          $table->string('location');
          $table->unsignedInteger('selling_price');
          $table->boolean('featured')->default(false);
          $table->string('coverImage');
          $table->unsignedInteger('units_available')->default('1');
          $table->date('year_built')->nullable();
          $table->morphs('standaloneable');
          $table->unsignedBigInteger('community_id')->nullable();
          $table->foreign('community_id')->references('id')->on('communities')->onDelete('cascade');
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
        Schema::dropIfExists('standalones');
    }
}
