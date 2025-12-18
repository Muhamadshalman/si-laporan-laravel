function showSection(section) {
    const upload = document.getElementById('upload-section');
    const riwayat = document.getElementById('riwayat-section');

    if(section === 'upload') {
        upload.classList.remove('hidden');
        riwayat.classList.add('hidden');
    } else {
        upload.classList.add('hidden');
        riwayat.classList.remove('hidden');
    }
}

// Default show upload
document.addEventListener('DOMContentLoaded', () => showSection('upload'));
