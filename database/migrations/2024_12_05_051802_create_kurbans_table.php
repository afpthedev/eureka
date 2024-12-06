<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKurbansTable extends Migration
{
    public function up()
    {
        Schema::create('kurbans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->constrained()->cascadeOnDelete(); // Bağışçı ilişkisi
            $table->enum('type', ['Nafile', 'Akika', 'Adak']); // Kurban türü
            $table->decimal('price', 10, 2); // Fiyat
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kurbans');
    }
}

