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