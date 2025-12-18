// Data Uraian Rekening untuk setiap Sub Kegiatan
const uraianOptions = {
      Penyusunan_Dokumen_Perencanaan_Perangkat_Daerah: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
        "Belanja Makanan dan Minuman Rapat",
        "Belanja Sewa Kendaraan Bermotor Penumpang",
        "Belanja Sewa Bangunan Gedung Tempat Pertemuan",
        "Belanja Jasa Konsultansi Berorientasi Layanan-Jasa Khusus",
        "Belanja Perjalanan Dinas Biasa",
        "Belanja Perjalanan Dinas Dalam Kota"
      ],
      Koordinasi_dan_Penyusunan_Dokumen_RKA_SKPD: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
        "Belanja Makanan dan Minuman Rapat",
        "Belanja Perjalanan Dinas Dalam Kota"
      ],
      Koordinasi_dan_Penyusunan_Dokumen_Perubahan_RKA_SKPD: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
        "Belanja Makanan dan Minuman Rapat",
        "Belanja Perjalanan Dinas Dalam Kota"
      ],
      Koordinasi_dan_Penyusunan_DPA_SKPD: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
        "Belanja Perjalanan Dinas Dalam Kota"
      ],
      Koordinasi_dan_Penyusunan_Perubahan_DPA_SKPD: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
        "Belanja Perjalanan Dinas Dalam Kota"
      ],
      Koordinasi_dan_Penyusunan_Laporan_Capaian_Kinerja_dan_Ikhtisar_Realisasi_Kinerja_SKPD: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
        "Belanja Makanan dan Minuman Rapat",
        "Belanja Sewa Kendaraan Bermotor Penumpang",
        "Belanja Perjalanan Dinas Biasa",
        "Belanja Perjalanan Dinas Dalam Kota"
      ],
      Evaluasi_Kinerja_Perangkat_Daerah: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
        "Belanja Makanan dan Minuman Rapat"
      ],
      Penyediaan_Gaji_dan_Tunjangan_ASN: [
        "Belanja Gaji Pokok PNS", "Belanja Gaji Pokok PPPK",
        "Belanja Tunjangan Keluarga PNS", "Belanja Tunjangan Keluarga PPPK",
        "Belanja Tunjangan Jabatan PNS", "Belanja Tunjangan Fungsional PNS",
        "Belanja Tunjangan Fungsional PPPK", "Belanja Tunjangan Fungsional Umum PNS",
        "Belanja Tunjangan Beras PNS", "Belanja Tunjangan Beras PPPK",
        "Belanja Tunjangan PPh/Tunjangan Khusus PNS", "Belanja Tunjangan PPh/Tunjangan Khusus PPPK",
        "Belanja Pembulatan Gaji PNS", "Belanja Pembulatan Gaji PPPK",
        "Belanja Iuran Jaminan Kecelakaan Kerja PNS", "Belanja Iuran Jaminan Kecelakaan Kerja PPPK",
        "Belanja Iuran Jaminan Kematian PNS", "Belanja Iuran Jaminan Kematian PPPK",
        "Tambahan Penghasilan berdasarkan Beban Kerja PNS",
        "Tambahan Penghasilan berdasarkan Beban Kerja PPPK",
        "Tambahan Penghasilan berdasarkan Kondisi Kerja PNS",
        "Tambahan Penghasilan berdasarkan Prestasi Kerja PNS",
        "Belanja Dana Operasional Pimpinan DPRD"
      ],
      Pelaksanaan_Penatausahaan_dan_Pengujian_Verifikasi_Keuangan_SKPD: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
        "Belanja Makanan dan Minuman Rapat",
        "Belanja Sewa Kendaraan Bermotor Penumpang",
        "Belanja Perjalanan Dinas Biasa",
        "Belanja Perjalanan Dinas Dalam Kota"
      ],
      Koordinasi_dan_Pelaksanaan_Akuntansi_SKPD: [
        "Belanja Makanan dan Minuman Rapat",
        "Belanja Perjalanan Dinas Dalam Kota"
      ],
      Koordinasi_dan_Penyusunan_Laporan_Keuangan_Bulanan_Triwulanan_Semesteran_SKPD: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
        "Belanja Makanan dan Minuman Rapat",
        "Belanja Perjalanan Dinas Biasa",
        "Belanja Perjalanan Dinas Dalam Kota"
      ],
      Penyusunan_Pelaporan_dan_Analisis_Prognosis_Realisasi_Anggaran: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
        "Belanja Makanan dan Minuman Rapat",
        "Belanja Perjalanan Dinas Dalam Kota"
      ],
      Penyelenggaraan_Administrasi_Keuangan_DPRD: [
        "Belanja Uang Representasi DPRD",
        "Belanja Tunjangan Keluarga DPRD",
        "Belanja Tunjangan Beras DPRD",
        "Belanja Uang Paket DPRD",
        "Belanja Tunjangan Jabatan DPRD",
        "Belanja Tunjangan Alat Kelengkapan DPRD",
        "Belanja Tunjangan Alat Kelengkapan Lainnya DPRD",
        "Belanja Tunjangan Komunikasi Intensif Pimpinan dan Anggota DPRD",
        "Belanja Tunjangan Reses DPRD",
        "Belanja Pembebanan PPh kepada Pimpinan dan Anggota DPRD",
        "Belanja Pembulatan Gaji DPRD",
        "Belanja Iuran Jaminan Kesehatan bagi DPRD",
        "Belanja Jaminan Kecelakaan Kerja DPRD",
        "Belanja Jaminan Kematian DPRD",
        "Belanja Tunjangan Perumahan DPRD",
        "Belanja Tunjangan Transportasi DPRD",
        "Belanja Uang Jasa Pengabdian DPRD"
      ],
      Pendidikan_dan_Pelatihan_Pegawai_Berdasarkan_Tugas_Dan_Fungsi: [
        "Belanja Sewa Kendaraan Bermotor Penumpang",
        "Belanja Bimbingan Teknis",
        "Belanja Perjalanan Dinas Biasa",
      ]
    };
