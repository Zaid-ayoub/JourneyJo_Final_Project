<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('custom_tours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // Foreign key to users table
            $table->string('location_input'); // Added new column for user typed location
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('number_of_people');
            $table->decimal('budget', 10, 2);
            $table->text('special_requirements')->nullable();
            $table->enum('transportation_preference', ['public', 'private']);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('company_id')->nullable()->constrained('users'); // Nullable foreign key to users table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_tours');
    }
};