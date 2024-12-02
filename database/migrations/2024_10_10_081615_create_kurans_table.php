<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKuransTable extends Migration
{
    public function up()
    {
        Schema::create('kurans', function (Blueprint $table) {
            $table->id();
            $table->integer('sura_number'); // Sura Numarası
            $table->string('sura_name'); // Sura Adı
            $table->integer('ayah_number'); // Ayet Numarası
            $table->text('text'); // Ayet Metni
            $table->decimal('amount', 8, 2)->default(50); // Bağış Miktarı (varsayılan 50)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kurans');
    }
}
