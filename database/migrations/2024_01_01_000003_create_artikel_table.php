<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artikel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penulis')->constrained('penulis')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_kategori')->constrained('kategori_artikel')->restrictOnDelete()->cascadeOnUpdate();
            $table->string('judul');
            $table->text('isi');
            $table->string('gambar');
            $table->string('hari_tanggal', 50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artikel');
    }
};
