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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('description');
            $table->string('image')->nullable();
            $table->decimal('price', 8, 2);
            $table->string('notes')->nullable();
            $table->string('allergens')->nullable();
            $table->string('benefits')->nullable();
            $table->string('aftercare_tips')->nullable();
            $table->string('cautions')->nullable();
//            $table->integer('duration_minutes')->default(15)->nullable();
            $table->foreignId('category_id')->nullable()->index();
            $table->boolean('is_hidden')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
