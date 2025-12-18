// Form Handler Functions

/**
 * Update dropdown Uraian Rekening berdasarkan Sub Kegiatan yang dipilih
 */
function updateSubKegiatan() {
  const kegiatan = document.getElementById('kegiatan');
  const sub = document.getElementById('sub_kegiatan');
  const val = kegiatan.value;
  
  sub.innerHTML = '<option value="">-- Pilih Uraian Rekening --</option>';
  
  if (uraianOptions[val]) {
    uraianOptions[val].forEach(item => {
      const opt = document.createElement('option');
      opt.value = item;        
      opt.textContent = item;
      sub.appendChild(opt);
    });
  }
}

/**
 * Sync nilai anggaran dari input format rupiah ke hidden input
 */
function syncAnggaran() {
  let nilai = document.getElementById('format-rupiah').value.replace(/[^0-9]/g, "");
  document.getElementById('jumlah-anggaran').value = nilai;
}

/**
 * Format input rupiah secara real-time
 */
function initRupiahFormat() {
  const formatInput = document.getElementById('format-rupiah');
  
  if (formatInput) {
    formatInput.addEventListener('input', function() {
      let angka = this.value.replace(/[^0-9]/g, '');
      
      // Update hidden input
      document.getElementById('jumlah-anggaran').value = angka;
      
      // Format tampilan
      this.value = new Intl.NumberFormat('id-ID').format(angka);
    });
  }
}

/**
 * Update preview file upload
 */
function updateFilePreview(inputId, previewId, iconId, textId) {
  const input = document.getElementById(inputId);
  const preview = document.getElementById(previewId);
  const icon = document.getElementById(iconId);
  const text = document.getElementById(textId);
  
  if (!input || !preview || !icon || !text) return;

  input.addEventListener('change', function () {
    const file = this.files[0];
    
    if (file) {
      icon.innerHTML = `<svg class="h-8 w-8 text-green-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
      </svg>`;
      
      text.textContent = file.name.length > 20 ? file.name.substring(0, 17) + '...' : file.name;
      text.classList.add('text-green-600', 'font-semibold');
      preview.classList.replace('border-gray-300', 'border-green-300');
      preview.classList.replace('bg-gray-50', 'bg-green-50');
      preview.classList.add('border-solid');
    } else {
      icon.innerHTML = `<svg class="h-8 w-8 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 014 4v2a2 2 0 01-2 2h-3l-2.939 2.939a.999.999 0 01-1.414 0L9 14H7a2 2 0 01-2-2v-2z" />
      </svg>`;
      
      text.textContent = 'Klik untuk unggah file PDF';
      text.classList.remove('text-green-600', 'font-semibold');
      preview.classList.replace('border-green-300', 'border-gray-300');
      preview.classList.replace('bg-green-50', 'bg-gray-50');
      preview.classList.remove('border-solid');
    }
  });
}