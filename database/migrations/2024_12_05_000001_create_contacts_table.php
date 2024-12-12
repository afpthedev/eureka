<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Kişi Adı');
            $table->string('phone')->unique()->comment('Telefon Numarası');
            $table->string('email')->nullable()->comment('E-Posta');
            $table->text('address')->nullable()->comment('Adres');
            $table->string('message_language')->default('TR')->comment('Mesaj Dili'); // Mesaj dili
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
