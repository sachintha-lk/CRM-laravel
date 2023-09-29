<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('user_id')->constrained();
            $table->boolean('is_paid')->default(false);
            $table->boolean('is_cancelled')->default(false);            // is abandoned
            $table->boolean('is_abandoned')->default(false);
            $table->double('total', 10, 2)->default(0);
            $table->timestamps();
        });

        // pivot table
        Schema::create('cart_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained();
            $table->foreignId('service_id')->constrained();
            $table->foreignId('time_slot_id')->constrained();
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->foreignId('location_id')->constrained();
            $table->double('price', 10, 2)->default(0);
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
        Schema::dropIfExists('cart_services');

    }
};
