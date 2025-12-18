// Data Uraian Rekening untuk setiap Sub Kegiatan
const uraianOptions = {
      rekonsiliasi_laporan_bmd_skpd: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor - Alat Tulis Kantor",
        "Belanja Makanan dan Minuman Rapat",
        "Belanja Perjalanan Dinas Dalam Kota"
      ],
      penatausahaan_bmd_skpd: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor - Alat Tulis Kantor",
        "Belanja Makanan dan Minuman Rapat",
        "Belanja Perjalanan Dinas Biasa",
        "Belanja Perjalanan Dinas Dalam Kota"
      ],
      pendataan_administrasi_kepegawaian: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor - Alat Tulis Kantor",
        "Belanja Sewa Kendaraan Bermotor Penumpang",
        "Belanja Perjalanan Dinas Biasa",
        "Belanja Perjalanan Dinas Dalam Kota"
      ],
      pelatihan_pegawai_tugas_fungsi: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor - Alat Tulis Kantor",
        "Belanja Sewa Kendaraan Bermotor Penumpang",
        "Belanja Perjalanan Dinas Biasa"
      ],
      bimtek_peraturan_perundangan: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor - Alat Tulis Kantor",
        "Belanja Sewa Kendaraan Bermotor Penumpang",
        "Belanja Kursus Singkat/Pelatihan",
        "Belanja Perjalanan Dinas Biasa"
      ],
      penyediaan_instalasi_listrik: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor - Alat Tulis Kantor"
      ],
      penyediaan_bahan_logistik: [
        "Belanja Bahan-Isi Tabung Pemadam Kebakaran",
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Benda Pos",
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Perabot Kantor",
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Perlengkapan Dinas",
        "Belanja Alat/Bahan untuk Kegiatan Kantor- Suvenir/Cendera Mata",
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat/Bahan untuk Kegiatan Kantor Lainnya",
        "Belanja Makanan dan Minuman Rapat",
        "Belanja Makanan dan Minuman Jamuan Tamu",
        "Belanja Jasa Tenaga Kebersihan",
        "Belanja Alat/Bahan Belanja Jasa Penyelenggaraan Acara"
      ],
      penyediaan_barang_cetakan_penggandaan: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor - Alat Tulis Kantor",
        "Belanja Alat/Bahan untuk Kegiatan Kantor- Kertas dan Cover",
        "Belanja Alat/Bahan untuk Kegiatan Kantor- Bahan Cetak"
      ],
      penyediaan_bahan_material: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
        "Belanja Alat/Bahan untuk Kegiatan Kantor- Kertas dan Cover",
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Bahan Komputer"
      ],
      rapat_koordinasi_konsultasi_skpd: [
        "Belanja Makanan dan Minuman Rapat",
        "Belanja Sewa Kendaraan Bermotor Penumpang",
        "Belanja Perjalanan Dinas Biasa",
        "Belanja Perjalanan Dinas Dalam Kota"
      ],
      penatausahaan_arsip_dinamis_skpd: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor - Alat Tulis Kantor",
        "Belanja Makanan dan Minuman Rapat",
        "Belanja Perjalanan Dinas Dalam Kota"
      ],
      pengadaan_kendaraan_dinas: [
        "Belanja Sewa Kendaraan Dinas Bermotor Perorangan"
      ],
      pengadaan_sarana_prasarana_gedung: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor - Alat Tulis Kantor",
        "Belanja Modal Personal Computer",
        "Belanja Modal Peralatan Personal Computer",
        "Belanja Modal Peralatan Komputer Lainnya"
      ],
      penyediaan_jasa_komunikasi_air_listrik: [
        "Belanja Jasa Tenaga Kebersihan",
        "Belanja Tagihan Telepon",
        "Belanja Tagihan Air",
        "Belanja Tagihan Listrik",
        "Belanja Kawat/Faksimili/Internet/TV Berlangganan"
      ],
      penyediaan_jasa_pelayanan_umum: [
        "Belanja Jasa Penyelenggaraan Acara",
        "Belanja jasa Pegawai Pemerintah dengan Perjanjian Kerja (PPPK) Paruh Waktu pada jabatan operator layanan operasional",
        "Belanja jasa Pegawai Pemerintah dengan Perjanjian Kerja (PPPK) Paruh Waktu pada jabatan pengelola layanan operasional",
        "Belanja jasa Pegawai Pemerintah dengan Perjanjian Kerja (PPPK) Paruh Waktu pada jabatan penata layanan operasional",
        "Belanja Iuran Jaminan Kesehatan bagi Non ASN",
        "Belanja Iuran Jaminan Kecelakaan Kerja bagi Non ASN",
        "Belanja Iuran Jaminan Kematian bagi Non ASN",
        "Belanja Iuran Jaminan Hari Tua bagi Non ASN"
      ],
      pemeliharaan_kendaraan_dinas_jabatan: [
        "Belanja Bahan-Bahan Bakar dan Pelumas",
        "Belanja Pembayaran Pajak, Bea, dan Perizinan",
        "Belanja Jasa Pemeliharaan Kendaraan Bermotor Dinas Perorangan/Jabatan"
      ],
      pemeliharaan_kendaraan_operasional: [
        "Belanja Bahan-Bahan Bakar dan Pelumas",
        "Belanja Pembayaran Pajak, Bea, dan Perizinan",
        "Belanja Pemeliharaan Alat Angkutan-Alat Angkutan Darat Bermotor-Kendaraan Bermotor Penumpang"
      ],
      pemeliharaan_peralatan_mesin: [
        "Belanja Bahan-Bahan Bakar dan Pelumas",
        "Belanja Pemeliharaan Alat Kantor dan Rumah Tangga-Alat Rumah Tangga-Alat Pendingin Udara",
        "Belanja Pemeliharaan Komputer-Komputer Unit-Personal Computer"
      ],
      pemeliharaan_sarana_prasarana_gedung: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
        "Belanja Jasa Konsultansi Pengawasan Rekayasa-Jasa Pengawas Pekerjaan Konstruksi Bangunan Gedung",
        "Belanja Pemeliharaan Bangunan Gedung-Bangunan Gedung Tempat Kerja-Bangunan Gedung Kantor",
        "Belanja Modal Bangunan Gedung Kantor"
      ],
      pendalaman_tugas_dprd: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor - Alat Tulis Kantor",
        "Belanja Alat/Bahan untuk Kegiatan Kantor- Kertas dan Cover",
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Bahan Cetak",
        "Belanja Makanan dan Minuman Rapat",
        "Honorarium Narasumber atau Pembahas, Moderator, Pembawa Acara, dan Panitia",
        "Honorarium Rohaniwan",
        "Belanja Sewa Kendaraan Bermotor Penumpang",
        "Belanja Kursus Singkat/Pelatihan",
        "Belanja Perjalanan Dinas Biasa"
      ],
      penyediaan_tenaga_ahli_fraksi: [
        "Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor",
        "Belanja Jasa Tenaga Administrasi",
        "Belanja Iuran Jaminan Kesehatan bagi Non ASN"
      ]
    };