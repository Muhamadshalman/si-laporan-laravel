const rupiahInput = document.getElementById('format-rupiah');
const hiddenJumlah = document.getElementById('jumlah-anggaran');

function formatRupiah(value) {
    let number_string = value.replace(/[^,\d]/g, '').toString();
    let split = number_string.split(',');
    let sisa = split[0].length % 3;
    let rupiah = split[0].substr(0, sisa);
    let ribuan = split[0].substr(sisa).match(/\d{3}/gi);
    if(ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    return rupiah;
}

function syncRupiah() {
    hiddenJumlah.value = rupiahInput.value.replace(/\./g, '');
    rupiahInput.value = formatRupiah(rupiahInput.value);
}

rupiahInput?.addEventListener('input', syncRupiah);
window.addEventListener('DOMContentLoaded', syncRupiah);
