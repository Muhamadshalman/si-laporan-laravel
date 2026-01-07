<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'bagian',
        'tanggal',
        'kegiatan',
        'sub_kegiatan',
        'uraian_kegiatan',
        'jumlah_anggaran',   
        'file_laporan',
        'file_pajak',
        'nama_file_laporan',  
        'nama_file_pajak', 
        'is_valid',
        'validated_at',
        'validated_by',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'is_valid' => 'boolean',
        'validated_at' => 'datetime',
    ];
}