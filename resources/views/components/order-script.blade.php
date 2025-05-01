<script>
  document.addEventListener('DOMContentLoaded', function () {
    const orderButtons = document.querySelectorAll('.order-btn');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalHarga = document.getElementById('modalHarga');
    const jumlahPesanan = document.getElementById('jumlahPesanan');
    const menuId = document.getElementById('menu_id');
    const totalHarga = document.getElementById('total_harga');
    const tambahPesananBtn = document.getElementById('addOrderBtn');

    orderButtons.forEach(button => {
      button.addEventListener('click', () => {
        const nama = button.getAttribute('data-nama');
        const gambar = button.getAttribute('data-gambar');
        const harga = parseInt(button.getAttribute('data-harga'));
        const idMenu = button.getAttribute('data-id');

        modalImage.src = gambar;
        modalTitle.innerText = nama;
        jumlahPesanan.value = 1;
        jumlahPesanan.dataset.hargaSatuan = harga;
        modalHarga.innerText = 'Rp. ' + harga.toLocaleString('id-ID');
        menuId.value = idMenu;
        totalHarga.value = harga;
      });
    });

    jumlahPesanan.addEventListener('input', () => {
      let quantity = parseInt(jumlahPesanan.value || 1);
      if (quantity < 1) quantity = 1;
      jumlahPesanan.value = quantity;

      const hargaSatuan = parseInt(jumlahPesanan.dataset.hargaSatuan);
      const total = hargaSatuan * quantity;
      modalHarga.innerText = 'Rp. ' + total.toLocaleString('id-ID');
      totalHarga.value = total;
    });

    tambahPesananBtn.addEventListener('click', () => {
      let quantity = parseInt(jumlahPesanan.value);
      quantity++;
      jumlahPesanan.value = quantity;

      const hargaSatuan = parseInt(jumlahPesanan.dataset.hargaSatuan);
      const total = hargaSatuan * quantity;
      modalHarga.innerText = 'Rp. ' + total.toLocaleString('id-ID');
      totalHarga.value = total;
    });

    document.getElementById('orderModal').addEventListener('hidden.bs.modal', () => {
      jumlahPesanan.value = 1;
      modalHarga.innerText = '';
      totalHarga.value = '';
      modalImage.src = '';
      modalTitle.innerText = '';
    });
  });
</script>
