<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Laporan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LaporanExportTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function superadmin_can_download_xlsx_export()
    {
        // Seed some laporan
        Laporan::factory()->create([
            'bagian' => 'umum',
            'tanggal' => now()->subDays(1),
            'kegiatan' => 'Kegiatan A',
            'sub_kegiatan' => 'Sub A',
            'uraian_kegiatan' => 'Penjelasan A',
            'jumlah_anggaran' => 1000000,
        ]);

        // Simulate superadmin session
        $response = $this->withSession(['role' => 'superadmin'])->get('/dashboard/umum/cetak?export=xlsx');

        $response->assertStatus(200);
        $response->assertHeader('Content-Disposition');
        $cd = $response->headers->get('Content-Disposition');
        $this->assertTrue(str_contains($cd, '.xlsx') || str_contains($cd, '.csv'), 'Response must contain .xlsx or .csv in Content-Disposition');
    }
}
