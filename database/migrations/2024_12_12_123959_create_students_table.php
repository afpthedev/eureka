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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('birth_country')->nullable();
            $table->json('citizenships')->nullable();
            $table->string('visa-status')->nullable();
            $table->string('school_status')->nullable();
            $table->string('military_status')->nullable();
            $table->string('parent_status',)->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_phone')->nullable();
            $table->string('hometown')->nullable();
            $table->json('languages')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('course_address')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('gender')->nullable(); // Cinsiyet (isteğe bağlı)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
