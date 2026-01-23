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
        Schema::create('transaksis', function (Blueprint $table) {
        $table->id();
        $table->string('nama_pelanggan');
        $table->text('alamat');
        $table->foreignId('jenis_layanan_id')
            ->constrained('jenis_layanans')
            ->cascadeOnDelete();
        $table->date('tanggal_berlangganan');
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
