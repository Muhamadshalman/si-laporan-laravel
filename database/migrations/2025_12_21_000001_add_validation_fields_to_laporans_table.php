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
        // Tambah kolom hanya jika belum ada (mencegah error duplicate column)
        if (! Schema::hasColumn('laporans', 'is_valid')) {
            Schema::table('laporans', function (Blueprint $table) {
                $table->boolean('is_valid')->default(false)->after('file_pajak');
            });
        }

        if (! Schema::hasColumn('laporans', 'validated_at')) {
            Schema::table('laporans', function (Blueprint $table) {
                $table->timestamp('validated_at')->nullable()->after('is_valid');
            });
        }

        if (! Schema::hasColumn('laporans', 'validated_by')) {
            Schema::table('laporans', function (Blueprint $table) {
                $table->string('validated_by')->nullable()->after('validated_at');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            if (Schema::hasColumn('laporans', 'is_valid')) {
                $table->dropColumn('is_valid');
            }
            if (Schema::hasColumn('laporans', 'validated_at')) {
                $table->dropColumn('validated_at');
            }
            if (Schema::hasColumn('laporans', 'validated_by')) {
                $table->dropColumn('validated_by');
            }
        });
    }
};