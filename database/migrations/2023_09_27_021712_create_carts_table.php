<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->boolean('is_paid')->default(false);
            $table->boolean('is_cancelled')->default(false);            // is abandoned
            $table->boolean('is_abandoned')->default(false);
            $table->double('total', 10, 2)->default(0);
            $table->timestamps();
        });

        // pivot table
        Schema::create('cart_services', function (Blueprint $table) {
            $table->foreignId('cart_id')->constrained();
            $table->foreignId('service_id')->constrained();
            $table->dateTime('service_start_date_time');
            $table->dateTime('service_end_date_time');
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
