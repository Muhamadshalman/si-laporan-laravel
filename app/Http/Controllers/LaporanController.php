<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;


class LaporanController extends Controller
{
    public function index($bagian)
{
    $riwayat = Laporan::where('bagian', $bagian)->latest()->get();

    return view("{$bagian}.dashboard", compact('riwayat', 'bagian'));
}

public function validasi($bagian, Request $request)
{
    // Hanya superadmin yang boleh mengakses halaman validasi
    if (session('role') !== 'superadmin') {
        return redirect()->route('dashboard', session('bagian') ?? $bagian)
            ->with('error', 'Akses ditolak: hanya superadmin yang dapat mengakses halaman ini.');
    }

    $query = Laporan::where('bagian', $bagian);

    // Pencarian sederhana pada beberapa kolom
    $q = $request->query('q');
    if ($q) {
        $query->where(function($sub) use ($q) {
            $sub->where('kegiatan', 'like', "%{$q}%")
                ->orWhere('uraian_kegiatan', 'like', "%{$q}%")
                ->orWhere('nama_file_laporan', 'like', "%{$q}%")
                ->orWhere('tanggal', 'like', "%{$q}%");
        });
    }

    $laporans = $query->latest()->get();

    return view('dashboard.validasi', compact('laporans', 'bagian', 'q'));
}

public function cetak($bagian, Request $request)
{
    // Hanya superadmin yang boleh mengakses halaman cetak
    if (session('role') !== 'superadmin') {
        return redirect()->route('dashboard', session('bagian') ?? $bagian)
            ->with('error', 'Akses ditolak: hanya superadmin yang dapat mengakses halaman ini.');
    }

    $query = Laporan::where('bagian', $bagian);

    // Dukungan pencarian sederhana pada halaman cetak
    $q = $request->query('q');
    if ($q) {
        $query->where(function($sub) use ($q) {
            $sub->where('kegiatan', 'like', "%{$q}%")
                ->orWhere('uraian_kegiatan', 'like', "%{$q}%")
                ->orWhere('nama_file_laporan', 'like', "%{$q}%")
                ->orWhere('tanggal', 'like', "%{$q}%");
        });
    }

    // **FILTER TANGGAL**
    $startDate = $request->query('start_date');
    $endDate = $request->query('end_date');
    
    if ($startDate && $endDate) {
        $query->whereBetween('tanggal', [$startDate, $endDate]);
    }

    $laporans = $query->orderBy('tanggal', 'desc')->get();

    // Export to native XLSX when requested
    if ($request->query('export') === 'xlsx') {
        if (class_exists(\PhpOffice\PhpSpreadsheet\Spreadsheet::class)) {
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            
            // **JUDUL LAPORAN**
            $sheet->setCellValue('A1', 'LAPORAN KEGIATAN - ' . strtoupper($bagian));
            $sheet->mergeCells('A1:E1');
            $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
            $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            
            // **INFORMASI PERIODE**
            if ($startDate && $endDate) {
                $sheet->setCellValue('A2', 'Periode: ' . date('d/m/Y', strtotime($startDate)) . ' s/d ' . date('d/m/Y', strtotime($endDate)));
                $sheet->mergeCells('A2:E2');
                $sheet->getStyle('A2')->getFont()->setBold(true);
                $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $headerRow = 4;
            } else {
                $headerRow = 3;
            }
            
            // **HEADER KOLOM**
            $headers = ['Tanggal', 'Kegiatan', 'Sub Kegiatan (Uraian Rekening)', 'Uraian Kegiatan', 'Jumlah Anggaran'];
            $sheet->fromArray($headers, NULL, 'A'.$headerRow);
            
            // **STYLING HEADER**
            $headerStyle = $sheet->getStyle('A'.$headerRow.':E'.$headerRow);
            $headerStyle->getFont()->setBold(true)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE));
            $headerStyle->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setRGB('4472C4'); // Biru
            $headerStyle->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $headerStyle->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            
            // **ISI DATA**
            $row = $headerRow + 1;
            foreach ($laporans as $lap) {
                $sheet->setCellValue('A'.$row, $lap->tanggal ? $lap->tanggal->format('d/m/Y') : '');
                $sheet->setCellValue('B'.$row, $lap->kegiatan);
                $sheet->setCellValue('C'.$row, $lap->sub_kegiatan);
                $sheet->setCellValue('D'.$row, $lap->uraian_kegiatan);
                $sheet->setCellValue('E'.$row, $lap->jumlah_anggaran);
                $row++;
            }
            
            // **BORDER UNTUK SEMUA DATA**
            if ($row > $headerRow + 1) {
                $dataRange = 'A'.$headerRow.':E'.($row-1);
                $sheet->getStyle($dataRange)->getBorders()->getAllBorders()
                    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            }
            
            // **FORMAT KOLOM**
            // Kolom A (Tanggal) - Center align
            $sheet->getStyle('A'.($headerRow+1).':A'.($row-1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            
            // Kolom E (Jumlah Anggaran) - Format currency dan right align
            if ($row > $headerRow + 1) {
                $sheet->getStyle('E'.($headerRow+1).':E'.($row-1))
                    ->getNumberFormat()
                    ->setFormatCode('#,##0');
                $sheet->getStyle('E'.($headerRow+1).':E'.($row-1))
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            }
            
            // **TEXT WRAP untuk kolom Uraian**
            $sheet->getStyle('D'.($headerRow+1).':D'.($row-1))
                ->getAlignment()
                ->setWrapText(true);
            
            // **LEBAR KOLOM**
            $sheet->getColumnDimension('A')->setWidth(12);  // Tanggal
            $sheet->getColumnDimension('B')->setWidth(35);  // Kegiatan
            $sheet->getColumnDimension('C')->setWidth(35);  // Sub Kegiatan
            $sheet->getColumnDimension('D')->setWidth(50);  // Uraian Kegiatan
            $sheet->getColumnDimension('E')->setWidth(18);  // Jumlah Anggaran
            
            // **TINGGI BARIS HEADER**
            $sheet->getRowDimension($headerRow)->setRowHeight(25);

            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            
            // **NAMA FILE DENGAN PERIODE**
            $dateRange = ($startDate && $endDate) ? '_'.date('Ymd', strtotime($startDate)).'_'.date('Ymd', strtotime($endDate)) : '';
            $filename = 'laporan_'.$bagian.$dateRange.'_'.now()->format('Ymd_His').'.xlsx';

            // Stream to client
            ob_start();
            $writer->save('php://output');
            $content = ob_get_clean();

            return response($content, 200, [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            ]);
        }

        // Fallback to CSV if PhpSpreadsheet isn't available
        $dateRange = ($startDate && $endDate) ? '_'.date('Ymd', strtotime($startDate)).'_'.date('Ymd', strtotime($endDate)) : '';
        $filename = 'laporan_'.$bagian.$dateRange.'_'.now()->format('Ymd_His').'.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($laporans, $startDate, $endDate, $bagian) {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Judul
            fputcsv($handle, ['LAPORAN KEGIATAN - ' . strtoupper($bagian)]);
            
            if ($startDate && $endDate) {
                fputcsv($handle, ['Periode: ' . date('d/m/Y', strtotime($startDate)) . ' s/d ' . date('d/m/Y', strtotime($endDate))]);
            }
            
            fputcsv($handle, []); // Baris kosong
            fputcsv($handle, ['Tanggal', 'Kegiatan', 'Sub Kegiatan (Uraian Rekening)', 'Uraian Kegiatan', 'Jumlah Anggaran']);

            foreach ($laporans as $lap) {
                fputcsv($handle, [
                    $lap->tanggal ? $lap->tanggal->format('d/m/Y') : '',
                    $lap->kegiatan,
                    $lap->sub_kegiatan,
                    $lap->uraian_kegiatan,
                    $lap->jumlah_anggaran,
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Export to Excel-compatible CSV
    if ($request->query('export') === 'excel') {
        $dateRange = ($startDate && $endDate) ? '_'.date('Ymd', strtotime($startDate)).'_'.date('Ymd', strtotime($endDate)) : '';
        $filename = 'laporan_'.$bagian.$dateRange.'_'.now()->format('Ymd_His').'.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($laporans, $startDate, $endDate, $bagian) {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Judul
            fputcsv($handle, ['LAPORAN KEGIATAN - ' . strtoupper($bagian)]);
            
            if ($startDate && $endDate) {
                fputcsv($handle, ['Periode: ' . date('d/m/Y', strtotime($startDate)) . ' s/d ' . date('d/m/Y', strtotime($endDate))]);
            }
            
            fputcsv($handle, []); // Baris kosong
            fputcsv($handle, ['Tanggal', 'Kegiatan', 'Sub Kegiatan (Uraian Rekening)', 'Uraian Kegiatan', 'Jumlah Anggaran']);

            foreach ($laporans as $lap) {
                fputcsv($handle, [
                    $lap->tanggal ? $lap->tanggal->format('d/m/Y') : '',
                    $lap->kegiatan,
                    $lap->sub_kegiatan,
                    $lap->uraian_kegiatan,
                    $lap->jumlah_anggaran,
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    return view('dashboard.cetak', compact('laporans', 'bagian', 'q'));
}

public function validateLaporan(Request $request, $bagian, $id)
{
    // Hanya superadmin (middleware sudah menjamin, ini double-check)
    if (session('role') !== 'superadmin') {
        return redirect()->route('dashboard', session('bagian') ?? $bagian)
            ->with('error', 'Akses ditolak: hanya superadmin yang dapat melakukan validasi.');
    }

    $laporan = Laporan::findOrFail($id);

    // Pastikan laporan milik bagian yang benar
    if ($laporan->bagian !== $bagian) {
        abort(403, 'Laporan tidak cocok dengan bagian.');
    }

    // Tandai sebagai tervalidasi
    $laporan->is_valid = true;
    $laporan->validated_at = now();
    $laporan->validated_by = session('role') ?? 'superadmin';
    $laporan->save();

    return redirect()->route('dashboard.validasi', $bagian)->with('success', 'Laporan berhasil divalidasi.');
}

    public function store(Request $request, $bagian)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kegiatan' => 'required|string',
            'sub_kegiatan' => 'required|string',
            'file_laporan' => 'required|file|mimes:pdf,doc,docx,xlsx,xls|max:10240',
            'file_pajak' => 'nullable|file|mimes:pdf,doc,docx,xlsx,xls|max:10240',
        ]);

        // Ambil & bersihkan nama asli
        $namaLaporan = str_replace([' ', '/', '\\', ':', '*', '?', '"', '<', '>', '|'], '_', $request->file('file_laporan')->getClientOriginalName());
        $namaPajak = $request->file('file_pajak') 
            ? str_replace([' ', '/', '\\', ':', '*', '?', '"', '<', '>', '|'], '_', $request->file('file_pajak')->getClientOriginalName())
            : null;

        // Simpan file
        $pathLaporan = $request->file('file_laporan')->store('laporan', 'public');
        $pathPajak = $request->file('file_pajak') 
            ? $request->file('file_pajak')->store('pajak', 'public')
            : null;

        // Simpan ke DB
        Laporan::create([
    'bagian' => $bagian,
    'tanggal' => $request->tanggal,
    'kegiatan' => $request->kegiatan,
    'sub_kegiatan' => $request->sub_kegiatan,
    'uraian_kegiatan' => $request->uraian_kegiatan,
    'jumlah_anggaran' => $request->jumlah_anggaran,
    'file_laporan' => $pathLaporan,
    'file_pajak' => $pathPajak,
    'nama_file_laporan' => $namaLaporan,
    'nama_file_pajak' => $namaPajak,
]);
    

        return redirect()->route('dashboard', $bagian)->with('success', 'Laporan berhasil diunggah!');
    }

public function download($type, $filename)
{
    $folder = $type === 'laporan' ? 'laporan' : 'pajak';
    $filePath = "$folder/$filename";

    if (!Storage::disk('public')->exists($filePath)) {
        abort(404);
    }

    // Ambil MIME type berdasarkan ekstensi
    $mimeType = Storage::disk('public')->mimeType($filePath);

    // Jika file PDF, coba buka di browser (preview)
    if ($mimeType === 'application/pdf') {
        return response()->file(
    Storage::disk('public')->path($filePath),
    [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="' . $filename . '"'
    ]
);
    }

    // Untuk file lain, tetap download
    return Storage::disk('public')->download($filePath);
}

    public function destroy($id)
{
    $laporan = Laporan::findOrFail($id);

    // Superadmin bebas hapus apa saja
    if (session('role') !== 'superadmin') {
        if ($laporan->bagian !== session('bagian')) {
            abort(403, 'Anda tidak boleh menghapus laporan bagian lain.');
        }
    }

    // Hapus file laporan jika ada
    if ($laporan->file_laporan && Storage::exists($laporan->file_laporan)) {
        Storage::delete($laporan->file_laporan);
    }

    // Hapus file pajak jika ada
    if ($laporan->file_pajak && Storage::exists($laporan->file_pajak)) {
        Storage::delete($laporan->file_pajak);
    }

    // Hapus record database
    $laporan->delete();

    return back()->with('success', 'Laporan berhasil dihapus.');
}
}