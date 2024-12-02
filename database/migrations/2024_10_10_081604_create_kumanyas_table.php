<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKumanyasTable extends Migration
{
    public function up()
    {
        Schema::create('kumanyas', function (Blueprint $table) {
            $table->id();
            $table->string('item_name'); // Ürün Adı
            $table->integer('quantity'); // Miktar
            $table->date('distribution_date'); // Dağıtım Tarihi
            $table->string('recipient'); // Alıcı
            $table->text('notes')->nullable(); // Notlar
            $table->decimal('amount', 8, 2)->default(50); // Bağış Miktarı (varsayılan 50)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kumanyas');
    }
}
