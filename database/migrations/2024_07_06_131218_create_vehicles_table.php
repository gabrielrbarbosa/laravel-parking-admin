<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained();

            $table->enum('vehicle_type', ['car', 'motorcycle, truck'])->default('car');
            $table->enum('size_type', ['hatchback', 'sedan', 'suv', 'pickup', 'van', 'motorcycle', 'truck'])->nullable();
            $table->enum('fuel_type', ['gasoline', 'ethanol', 'flex', 'diesel', 'electric', 'hybrid'])->nullable();
            $table->enum('transmission_type', ['manual', 'automatic'])->nullable();

            $table->string('license_plate', 10)->unique();
            $table->string('description')->nullable();
            $table->foreignId('brand_id')->constrained();
            $table->string('model')->nullable();
            $table->string('year', 4)->nullable();
            $table->string('color')->nullable();
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
};
