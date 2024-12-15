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
        Schema::create('apartment_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('apartment_name'); // Daire adı
            $table->date('start_date');       // Başlangıç tarihi
            $table->date('end_date');         // Bitiş tarihi
            $table->text('description')->nullable(); // Açıklama
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartment_bookings');
    }
};
