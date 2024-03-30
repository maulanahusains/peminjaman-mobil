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
    Schema::create('kendaraans', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('id_jenis');
      $table->unsignedBigInteger('id_user');
      $table->string('nama');
      $table->string('tipe');
      $table->string('plat_nomor');
      $table->string('jenis_plat');
      $table->boolean('isLending')->default(0);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('kendaraans');
  }
};
