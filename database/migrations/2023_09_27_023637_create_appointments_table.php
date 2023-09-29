<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {

        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('appointment_code')->unique();
            $table->foreignId('cart_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('service_id')->constrained();
            $table->date('date');
            $table->foreignId('time_slot_id')->constrained();
            $table->time('start_time');
            $table->time('end_time');
            $table->foreignId('location_id')->constrained();
            $table->double('total', 10, 2)->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
