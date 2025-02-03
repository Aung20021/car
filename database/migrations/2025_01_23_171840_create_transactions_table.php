<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('car_id')->constrained('cars')->onDelete('cascade'); // Foreign Key to Cars
            $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade'); // Foreign Key to Users (Buyer)
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade'); // Foreign Key to Users (Owner)
            $table->decimal('amount', 10, 2); // Payment Amount
            $table->enum('status', ['in_process', 'succeeded', 'failed'])->default('in_process'); // Transaction Status
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
