<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Jika ada foreign key pada kolom validated_by, drop dulu
        $fk = DB::select("SELECT CONSTRAINT_NAME as constraint_name
            FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
            WHERE TABLE_SCHEMA = DATABASE()
              AND TABLE_NAME = 'laporans'
              AND COLUMN_NAME = 'validated_by'
              AND REFERENCED_TABLE_NAME IS NOT NULL
            LIMIT 1");

        if (!empty($fk) && !empty($fk[0]->constraint_name)) {
            $fkName = $fk[0]->constraint_name;
            DB::statement("ALTER TABLE `laporans` DROP FOREIGN KEY `$fkName`");
        }

        // Ubah kolom validated_by menjadi VARCHAR(255) NULL
        DB::statement("ALTER TABLE `laporans` MODIFY `validated_by` VARCHAR(255) NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Coba kembalikan ke INT (nullable) — tanpa menambahkan FK kembali
        DB::statement("ALTER TABLE `laporans` MODIFY `validated_by` INT NULL");
    }
};