// UI Handler Functions

/**
 * Set active button style untuk navigation
 */
function setActiveButton(isUpload) {
  const buttonIds = ['btn-upload', 'btn-riwayat', 'btn-upload-mobile', 'btn-riwayat-mobile'];
  
  // Remove active class dari semua button
  buttonIds.forEach(id => {
    const el = document.getElementById(id);
    if (el) el.classList.remove('text-blue-600', 'font-bold');
  });
  
  // Add active class ke button yang dipilih
  const activeIds = isUpload ? ['btn-upload', 'btn-upload-mobile'] : ['btn-riwayat', 'btn-riwayat-mobile'];
  activeIds.forEach(id => {
    const el = document.getElementById(id);
    if (el) el.classList.add('text-blue-600', 'font-bold');
  });
}

/**
 * Show section Upload Laporan
 */
function showUpload() {
  document.getElementById('upload-section').classList.remove('hidden');
  document.getElementById('riwayat-section').classList.add('hidden');
  setActiveButton(true);
}

/**
 * Show section Riwayat Laporan
 */
function showRiwayat() {
  document.getElementById('riwayat-section').classList.remove('hidden');
  document.getElementById('upload-section').classList.add('hidden');
  setActiveButton(false);
}

/**
 * Search/Filter function untuk tabel riwayat
 */
function initSearchFilter() {
  const searchInput = document.getElementById('searchInput');
  
  if (searchInput) {
    searchInput.addEventListener('input', function() {
      const term = this.value.toLowerCase();
      const rows = document.querySelectorAll('#riwayatTable tr');
      
      rows.forEach(row => {
        // Skip header row
        if (row.querySelector('th')) return;
        
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(term) ? '' : 'none';
      });
    });
  }
}