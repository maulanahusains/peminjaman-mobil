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
    Schema::create('peminjamen', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('id_kendaraan');
      $table->unsignedBigInteger('penanggung_jawab');
      $table->string('kebutuhan');
      $table->date('tanggal_pinjam');
      $table->date('tanggal_kembali');
      $table->text('agenda');
      $table->string('status');
      $table->timestamps();

      $table->foreign('id_kendaraan')->references('id')->on('kendaraans')->onDelete('cascade');
      $table->foreign('penangggung_jawab')->references('id')->on('users')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('peminjamen');
  }
};
