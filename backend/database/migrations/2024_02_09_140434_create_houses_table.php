<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            // longitute/lattitude
            $table->decimal("location_latitude", 10, 8);
            $table->decimal("location_longitude", 11, 8);
            // store image link as json
            $table->json('images')->nullable();
            // owner
            $table->integer('nbr_bedroom')->default(0);
            $table->integer('nbr_bath')->default(0);
            $table->boolean('wifi')->nullable();
            $table->boolean('is_equipped')->nullable();
            $table->boolean('is_furnished')->nullable();
            $table->float('surface')->nullable();
            $table->enum('type', ['apartment', 'duplex', 'reyad', 'villa', 'penthouse'])->default('apartment');
            $table->string('title');
            $table->text('desc');
            $table->enum('rent_by', ['year', 'semester', 'trimester', 'month' , 'week', 'day'])->nullable();
            $table->float('rent_price');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('houses');
    }
};
