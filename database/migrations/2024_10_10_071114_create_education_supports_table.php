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
        Schema::create('education_supports', function (Blueprint $table) {
            $table->id();
            $table->string('first_name'); // İsim
            $table->string('last_name');  // Soyisim
            $table->integer('amount')->default(50); // Miktar, varsayılan 50
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_supports');
    }
};
