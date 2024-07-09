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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('city_id')->nullable()->constrained();
            $table->string('tour_name');
            $table->string('image')->nullable();
            $table->decimal('budget', 7, 2)->default(0.00);
            $table->integer('duration');
            $table->integer('number_of_people');
            $table->string('type'); //one of the 4 types we support
            $table->string('created_by');//admin or user or ai 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};