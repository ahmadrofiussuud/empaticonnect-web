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
        Schema::create('helpers_profile', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->enum('tier', ['buddy', 'pro_care'])->default('buddy');
            $table->json('skills'); // Stores array of skills like ["mobility_assistance", "medical_care"]
            $table->boolean('is_verified')->default(false);
            $table->decimal('hourly_rate', 8, 2);
            $table->enum('availability_status', ['available', 'busy', 'offline'])->default('available');
            $table->decimal('rating', 3, 2)->nullable(); // 0.00 to 5.00
            $table->timestamps();
            
            // Indexes for filtering and sorting
            $table->index(['is_verified', 'availability_status']);
            $table->index('tier');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('helpers_profile');
    }
};
