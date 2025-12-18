const fileInput = document.getElementById('file_laporan_input');
const filePreview = document.getElementById('file_laporan_preview');
const fileText = document.getElementById('text_laporan');

filePreview.addEventListener('click', () => fileInput.click());
fileInput.addEventListener('change', () => {
    if(fileInput.files.length > 0) {
        fileText.textContent = fileInput.files[0].name;
    } else {
        fileText.textContent = 'Klik untuk unggah file PDF';
    }
});
