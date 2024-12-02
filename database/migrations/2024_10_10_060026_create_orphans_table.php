<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrphansTable extends Migration
{
    public function up()
    {
        Schema::create('orphans', function (Blueprint $table) {
            $table->id();
            $table->string('first_name'); // İsim
            $table->string('last_name');  // Soyisim
            $table->integer('amount')->default(50); // Miktar, varsayılan 50
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orphans');
    }
}
