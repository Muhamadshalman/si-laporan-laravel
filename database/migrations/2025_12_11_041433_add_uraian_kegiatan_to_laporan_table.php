<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->text('uraian_kegiatan')->nullable();
            $table->bigInteger('jumlah_anggaran')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropColumn('uraian_kegiatan');
            $table->dropColumn('jumlah_anggaran');
        });
    }
};
