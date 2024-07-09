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
        Schema::create('tour_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_day_id')->constrained();
            $table->string('activity_type'); //resturant or historcal site or medical place or place to go
            $table->integer('reference_id')->nullable(); // depend on the activity type if its for a resturant it will be the resturant id and so on ..
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->text('additional_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_activities');
    }
};
