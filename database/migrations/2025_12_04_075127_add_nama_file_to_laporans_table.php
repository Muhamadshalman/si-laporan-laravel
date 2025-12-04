<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('laporans', function (Blueprint $table) {
        $table->string('nama_file_laporan')->after('file_laporan');
        $table->string('nama_file_pajak')->nullable()->after('file_pajak');
    });
}

public function down()
{
    Schema::table('laporans', function (Blueprint $table) {
        $table->dropColumn(['nama_file_laporan', 'nama_file_pajak']);
    });
}
};
