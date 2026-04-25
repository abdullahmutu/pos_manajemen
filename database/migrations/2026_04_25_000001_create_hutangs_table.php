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
        Schema::create('hutangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peminjam');
            $table->string('nomor_hp')->nullable();
            $table->text('alamat')->nullable();
            $table->decimal('jumlah_hutang', 15, 2);
            $table->decimal('jumlah_bayar', 15, 2)->default(0);
            $table->string('status')->default('belum_lunas'); // belum_lunas, sebagian_lunas, lunas
            $table->date('tanggal_hutang');
            $table->date('tanggal_jatuh_tempo')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hutangs');
    }
};
