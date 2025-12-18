// Main Application Script

/**
 * Initialize semua fungsi saat DOM ready
 */
document.addEventListener('DOMContentLoaded', () => {
  // Initialize form handlers
  initFormHandlers();
  
  // Initialize UI handlers
  initUIHandlers();
  
  // Show riwayat section by default
  showRiwayat();
});

/**
 * Initialize form-related event handlers
 */
function initFormHandlers() {
  // Event listener untuk dropdown kegiatan
  const kegiatanSelect = document.getElementById('kegiatan');
  if (kegiatanSelect) {
    kegiatanSelect.addEventListener('change', updateSubKegiatan);
  }
  
  // Initialize format rupiah
  initRupiahFormat();
  
  // Sync anggaran saat halaman dibuka
  syncAnggaran();
  
  // Initialize file upload previews
  updateFilePreview('file_laporan_input', 'file_laporan_preview', 'icon_laporan', 'text_laporan');
  updateFilePreview('file_pajak_input', 'file_pajak_preview', 'icon_pajak', 'text_pajak');
}

/**
 * Initialize UI-related event handlers
 */
function initUIHandlers() {
  // Initialize search filter
  initSearchFilter();
  
  // Auto-hide success notification after 4 seconds
  const notification = document.querySelector('.fixed.top-4');
  if (notification) {
    setTimeout(() => notification.remove(), 4000);
  }
}