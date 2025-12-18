const searchInput = document.getElementById('searchInput');
const table = document.getElementById('riwayatTable');

searchInput?.addEventListener('input', () => {
    const filter = searchInput.value.toLowerCase();
    Array.from(table.rows).forEach(row => {
        row.style.display = Array.from(row.cells).some(cell =>
            cell.textContent.toLowerCase().includes(filter)
        ) ? '' : 'none';
    });
});
