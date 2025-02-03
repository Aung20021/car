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
        Schema::create('cars', function (Blueprint $table) {
           $table->id();
            $table->string('make'); // Car make
            $table->string('model'); // Car model
            $table->year('year'); // Manufacturing year
            $table->integer('mileage'); // Mileage
            $table->enum('fuel_type', ['Petrol', 'Diesel', 'Electric', 'Hybrid']); // Fuel type
            $table->enum('transmission', ['Manual', 'Automatic','Hybrid']); // Transmission type
            $table->string('engine_size'); // Engine size
            $table->string('engine_power'); // Engine power output
            $table->string('body_type'); // Body type
            $table->string('vin')->unique(); // Vehicle Identification Number
            $table->enum('insurance_status', ['Active', 'Expired']); // Insurance status
            $table->enum('warranty_status', ['Remaining', 'Expired'])->nullable(); // Warranty status
            $table->enum('tire_condition', ['bad', 'good', 'excellent'])->nullable(); // Tire condition
            $table->enum('mechanical_health', ['bad', 'good', 'excellent'])->nullable(); // Engine and mechanical health
            $table->decimal('price', 10, 2); // Price
            $table->string('seller_name'); // Dealer/Private seller name
            $table->string('location'); // Location (City/Area)
            $table->string('contact_information'); // Contact information
            $table->json('photos')->nullable(); // High-quality photos (stored as JSON paths)
            $table->text('video_walkaround')->nullable(); // Video walkaround
            $table->enum('test_drive_availability', ['Yes', 'No']); // Test drive availability
            $table->timestamp('test_drive_start')->nullable();
            $table->timestamp('test_drive_end')->nullable();


            $table->string('registration_details'); // Registration details
            $table->unsignedBigInteger('user_id'); // Foreign key for user
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Revers e the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
