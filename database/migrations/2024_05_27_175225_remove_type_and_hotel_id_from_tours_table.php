<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropForeign(['hotel_id']);
            $table->dropColumn(['type', 'hotel_id']);
        });
    }

    public function down()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->string('type')->nullable();
            $table->foreignId('hotel_id')->nullable()->constrained('hotels')->onDelete('CASCADE');

        });
    }
};
