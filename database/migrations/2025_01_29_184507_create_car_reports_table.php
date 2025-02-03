<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('car_reports', function (Blueprint $table) {
        $table->id();
        $table->foreignId('car_id')->constrained('cars')->onDelete('cascade'); // Foreign key to cars table
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key to users table
        $table->string('reason'); // Reason for reporting the car
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_reports');
    }
};
