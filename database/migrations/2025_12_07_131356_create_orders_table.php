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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('titiper_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('runner_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('pickup_location_id')->constrained('locations')->onDelete('cascade');
            $table->foreignId('delivery_location_id')->constrained('locations')->onDelete('cascade');
            $table->enum('status', ['waiting_runner', 'accepted', 'arrived_at_pickup', 'item_picked', 'on_delivery', 'delivered', 'completed', 'cancelled'])->default('waiting_runner');
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('service_fee', 10, 2)->default(3000);
            $table->decimal('total_price', 10, 2);
            $table->text('notes')->nullable();
            $table->enum('payment_method', ['cash'])->default('cash');
            $table->string('delivery_proof')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
