<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourLocationTable extends Migration
{
    public function up()
    {
        Schema::create('tour_location', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id')->constrained('tours', 'tour_id')->onDelete('cascade');
            $table->foreignId('location_id')->constrained('locations', 'location_id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tour_location');
    }
}