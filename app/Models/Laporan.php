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
        'file_laporan',
        'file_pajak',
        'nama_file_laporan',  
        'nama_file_pajak',    
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}