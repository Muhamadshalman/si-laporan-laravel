<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Middleware\CheckBagian;

// ===============================
// 🔹 HALAMAN PUBLIK
// ===============================
Route::get('/', function () {
    return view('auth.welcome');
})->name('welcome');

Route::get('/tentang', function () {
    return view('pages.tentang');
})->name('tentang');

Route::get('/informasi', function () {
    return view('pages.informasi');
})->name('informasi');


// ======================================
// 🔹 LOGIN & LOGOUT
// ======================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// ======================================
// 🔹 SUPERADMIN DASHBOARD KHUSUS
// ======================================
Route::get('/superadmin/dashboard', function () {
    return view('superadmin.dashboard');
})->name('superadmin.dashboard');  // ← Tambah DI SINI!

// ======================================
// 🔹 SUPERADMIN AKSES SEMUA BAGIAN
// ======================================
Route::get('/dashboard/{bagian}', [LaporanController::class, 'index'])
    ->whereIn('bagian', ['umum', 'keuangan', 'persidangan', 'fasilitasi'])
    ->name('dashboard'); // ← WAJIB ADA!

// Validasi laporan (tampilan daftar untuk validasi)
use App\Http\Middleware\CheckSuperadmin;

Route::get('/dashboard/{bagian}/validasi', [LaporanController::class, 'validasi'])
    ->whereIn('bagian', ['umum', 'keuangan', 'persidangan', 'fasilitasi'])
    ->middleware(CheckSuperadmin::class)
    ->name('dashboard.validasi');

// Cetak laporan (hanya superadmin)
Route::get('/dashboard/{bagian}/cetak', [LaporanController::class, 'cetak'])
    ->whereIn('bagian', ['umum', 'keuangan', 'persidangan', 'fasilitasi'])
    ->middleware(CheckSuperadmin::class)
    ->name('dashboard.cetak');

// Proses validasi (hanya superadmin)
Route::post('/dashboard/{bagian}/laporan/{id}/validate', [LaporanController::class, 'validateLaporan'])
    ->whereIn('bagian', ['umum', 'keuangan', 'persidangan', 'fasilitasi'])
    ->middleware(CheckSuperadmin::class)
    ->name('laporan.validate');


/*
|--------------------------------------------------------------------------
| 🔹 ROUTE KHUSUS USER BAGIAN (dibatasi middleware)
|--------------------------------------------------------------------------
| User biasa hanya bisa akses sesuai bagian yang ada di session.
*/
Route::middleware([CheckBagian::class])->group(function () {

    // Upload laporan
    Route::post('/dashboard/{bagian}/laporan', [LaporanController::class, 'store'])
        ->name('laporan.store');

});

// Dev-only route: quick test for XLSX export (only in local environment)
if (app()->environment('local')) {
    Route::get('/_dev/test-laporan-export', function () {
        $collection = collect([
            (object)[
                'tanggal' => now(),
                'kegiatan' => 'Contoh Kegiatan',
                'sub_kegiatan' => 'Contoh Sub Kegiatan (Uraian Rekening)',
                'uraian_kegiatan' => 'Contoh uraian kegiatan untuk pengujian ekspor.',
                'jumlah_anggaran' => 1500000,
            ],
            (object)[
                'tanggal' => now()->subDays(2),
                'kegiatan' => 'Kegiatan B',
                'sub_kegiatan' => 'Sub B',
                'uraian_kegiatan' => 'Uraian B',
                'jumlah_anggaran' => 2500000,
            ],
        ]);

        if (class_exists(\PhpOffice\PhpSpreadsheet\Spreadsheet::class)) {
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->fromArray(['Tanggal', 'Kegiatan', 'Sub Kegiatan (Uraian Rekening)', 'Uraian Kegiatan', 'Jumlah Anggaran'], NULL, 'A1');
            $row = 2;
            foreach ($collection as $lap) {
                $sheet->fromArray([
                    $lap->tanggal ? $lap->tanggal->format('Y-m-d') : '',
                    $lap->kegiatan,
                    $lap->sub_kegiatan,
                    $lap->uraian_kegiatan,
                    $lap->jumlah_anggaran,
                ], NULL, 'A'.$row);
                $row++;
            }
            $sheet->getStyle('A1:E1')->getFont()->setBold(true);
            foreach (range('A', 'E') as $col) {
                $sheet->getColumnDimension($col)->setAutoSize(true);
            }
            if ($row > 2) {
                $sheet->getStyle('E2:E'.($row-1))->getNumberFormat()->setFormatCode('#,##0');
            }

            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $filename = 'laporan_test_'.now()->format('Ymd_His').'.xlsx';
            ob_start();
            $writer->save('php://output');
            $content = ob_get_clean();
            return response($content, 200, [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            ]);
        }

        // Fallback to CSV
        $filename = 'laporan_test_'.now()->format('Ymd_His').'.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];
        $callback = function() use ($collection) {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($handle, ['Tanggal', 'Kegiatan', 'Sub Kegiatan (Uraian Rekening)', 'Uraian Kegiatan', 'Jumlah Anggaran']);
            foreach ($collection as $lap) {
                fputcsv($handle, [
                    $lap->tanggal ? $lap->tanggal->format('Y-m-d') : '',
                    $lap->kegiatan,
                    $lap->sub_kegiatan,
                    $lap->uraian_kegiatan,
                    $lap->jumlah_anggaran,
                ]);
            }
            fclose($handle);
        };
        return response()->stream($callback, 200, $headers);
    });
}


// ======================================
// 🔹 HAPUS LAPORAN (superadmin & pemilik)
// ======================================
Route::delete('/laporan/{id}', [LaporanController::class, 'destroy'])
    ->name('laporan.destroy');


// ======================================
// 🔹 DOWNLOAD FILE (semua yang login boleh)
// ======================================
Route::get('/download/{type}/{filename}', [LaporanController::class, 'download'])
    ->name('laporan.download');
