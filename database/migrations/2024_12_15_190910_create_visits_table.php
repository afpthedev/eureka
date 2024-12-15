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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->constrained()->onDelete('cascade'); // Bağlantı Contact tablosuna
            $table->timestamp('entry_time')->nullable(); // Giriş zamanı
            $table->timestamp('exit_time')->nullable();  // Çıkış zamanı
            $table->string('purpose')->nullable();       // Ziyaret nedeni
            $table->text('notes')->nullable();           // Notlar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
