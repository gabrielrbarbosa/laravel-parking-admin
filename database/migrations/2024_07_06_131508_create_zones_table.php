<?php

use App\Models\Zone;
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
        Schema::create('zones', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->decimal('price_per_hour');
            $table->decimal('price_per_month');

            $table->timestamps();
        });

        Zone::create(['name' => 'Green Zone', 'price_per_hour' => 5, 'price_per_month' => 100]);
        Zone::create(['name' => 'Yellow Zone', 'price_per_hour' => 10, 'price_per_month' => 200]);
        Zone::create(['name' => 'Red Zone', 'price_per_hour' => 20, 'price_per_month' => 300]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zones');
    }
};
