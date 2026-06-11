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
        Schema::create('catering_orders', function (Blueprint $table) {
            $table->id();

            $table->string('nama_lengkap');
            $table->string('no_whatsapp');
            $table->string('email')->nullable();

            $table->string('jenis_acara');
            $table->integer('jumlah_tamu');

            $table->date('tanggal_acara');

            $table->bigInteger('budget')->nullable();

            $table->text('preferensi_menu');
            $table->text('catatan_tambahan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catering_orders');
    }
};