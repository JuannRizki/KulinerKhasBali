<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard - Fooder</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


  <link href="{{ asset('css/pesanan.css') }}" rel="stylesheet" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    .card.pesanan {
      border: none;
      border-radius: 15px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
      font-size: 0.85rem;
    }
    .card.pesanan img {
      height: 150px;
      object-fit: cover;
      border-top-left-radius: 15px;
      border-top-right-radius: 15px;
    }
    .card.pesanan .card-body {
      padding: 0.75rem;
    }
    .star-rating label {
      font-size: 1.2rem;
    }
  </style>
</head>
<body class="bg-fixed bg-cover bg-center" style="background-image: url('{{ asset('images/bali4.jpg') }}');">

  <div class="min-h-screen flex flex-col bg-white/70 backdrop-blur-md">

    <x-navbar />

    <div class="pt-24 px-4 flex-1">
      @yield('content')
    </div>

    <x-order-modal />

    {{-- Footer --}}
    <x-footer />

  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const orderButtons = document.querySelectorAll('.order-btn');
      const orderModal = document.getElementById('orderModal');
      const modalImage = document.getElementById('modalImage');
      const modalTitle = document.getElementById('modalTitle');
      const modalHarga = document.getElementById('modalHarga');
      const jumlahPesanan = document.getElementById('jumlahPesanan');
      const menuId = document.getElementById('menu_id');
      const totalHarga = document.getElementById('total_harga');
      const alamatInput = document.getElementById('alamat');  // input alamat

      orderButtons.forEach(button => {
        button.addEventListener('click', (e) => {
          e.preventDefault();
          orderModal.classList.remove('hidden');

          const nama = button.dataset.nama;
          const gambar = button.dataset.gambar;
          const harga = Number(button.dataset.harga);
          const idMenu = button.dataset.id;
          const alamat = button.dataset.alamat || '';

          modalImage.src = gambar;
          modalTitle.textContent = nama;
          jumlahPesanan.value = 1;
          modalHarga.textContent = 'Rp. ' + harga.toLocaleString('id-ID');
          menuId.value = idMenu;
          totalHarga.value = harga;

          alamatInput.value = alamat;

          jumlahPesanan.oninput = () => {
            let quantity = parseInt(jumlahPesanan.value);
            if (isNaN(quantity) || quantity < 1) quantity = 1;
            jumlahPesanan.value = quantity;

            const total = harga * quantity;
            modalHarga.textContent = 'Rp. ' + total.toLocaleString('id-ID');
            totalHarga.value = total;
          };
        });
      });
    });
  </script>

</body>
</html>
