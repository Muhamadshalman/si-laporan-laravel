<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Laporan;


class PersidanganController extends Controller
{
    public function index($bagian)
{
    $riwayat = Laporan::where('bagian', $bagian)
                      ->orderBy('created_at', 'desc')
                      ->get();
    
    return view('persidangan.dashboard', compact('bagian', 'riwayat'));
}
    $request->validate(['ids' => 'required|string']);

    $ids = explode(',', $request->ids);
    $laporans = Laporan::whereIn('id', $ids)->get();

    foreach ($laporans as $l) {
        if ($l->file_laporan) Storage::disk('public')->delete($l->file_laporan);
        if ($l->file_pajak) Storage::disk('public')->delete($l->file_pajak);
        $l->delete();
    }

    return redirect()->route('dashboard.persidangan')->with('success', 'Laporan terpilih berhasil dihapus.');
}
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kegiatan' => 'required|string|max:255',
            'sub_kegiatan' => 'required|string|max:255',
            'file_laporan' => 'required|file|mimes:pdf,doc,docx,xlsx,xls|max:5120',
            'file_pajak' => 'nullable|file|mimes:pdf,doc,docx,xlsx,xls|max:5120',
        ]);

        // Bersihkan nama file asli dari karakter ilegal
        $originalLaporan = $request->file('file_laporan')->getClientOriginalName();
        $namaAsliLaporan = str_replace(
            [' ', '/', '\\', ':', '*', '?', '"', '<', '>', '|'],
            '_',
            $originalLaporan
        );

        $namaAsliPajak = null;
        if ($request->hasFile('file_pajak')) {
            $originalPajak = $request->file('file_pajak')->getClientOriginalName();
            $namaAsliPajak = str_replace(
                [' ', '/', '\\', ':', '*', '?', '"', '<', '>', '|'],
                '_',
                $originalPajak
            );
        }

        // Simpan file dengan nama unik di storage
        $pathLaporan = $request->file('file_laporan')->store('laporan', 'public');
        $pathPajak = $request->hasFile('file_pajak')
            ? $request->file('file_pajak')->store('pajak', 'public')
            : null;

        // Simpan ke database
        Laporan::create([
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan,
            'sub_kegiatan' => $request->sub_kegiatan,
            'file_laporan' => $pathLaporan,
            'file_pajak' => $pathPajak,
            'nama_file_laporan' => $namaAsliLaporan,
            'nama_file_pajak' => $namaAsliPajak,
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil diunggah!');
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

        if ($laporan->file_laporan) {
            Storage::disk('public')->delete($laporan->file_laporan);
        }
        if ($laporan->file_pajak) {
            Storage::disk('public')->delete($laporan->file_pajak);
        }

        $laporan->delete();

        return redirect()->back()->with('success', 'Laporan berhasil dihapus.');
    }
}