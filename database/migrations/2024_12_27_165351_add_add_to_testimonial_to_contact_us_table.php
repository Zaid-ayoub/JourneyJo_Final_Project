<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddToTestimonialToContactUsTable extends Migration
{
    public function up()
    {
        Schema::table('contact_us', function (Blueprint $table) {
            $table->boolean('add_to_testimonial')->default(0); // Add the column with a default value of 0
        });
    }

    public function down()
    {
        Schema::table('contact_us', function (Blueprint $table) {
            $table->dropColumn('add_to_testimonial'); // Drop the column in case of rollback
        });
    }
}