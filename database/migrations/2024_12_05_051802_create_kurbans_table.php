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
            $table->date('sacrifice_date'); // Kurban Kesim Tarih
            $table->decimal('price',8, 2)->default(150); // Bağış Miktarı (varsayılan 50)
            $table->timestamps();
            $table->string('status')->default('Ödenmedi'); // Durum (Ödendi, Ödenmedi)
            $table->string('Notes')->nullable(); // Notlar (isteğe bağlı)
            $table->string('payment_type')->nullable(); // Ödeme Türü (isteğe bağlı)
            $table->string('association')->nullable(); // Kurban Derneği (isteğe bağlı)
        });
    }

    public function down()
    {
        Schema::dropIfExists('kurbans');
    }
}

