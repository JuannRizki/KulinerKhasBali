<!-- resources/views/components/order-modal.blade.php -->
@auth
<div class="fixed inset-0 hidden flex items-center justify-center bg-black bg-opacity-50 z-50" id="orderModal">
  <div class="bg-white rounded-lg w-96 p-6 relative">
    <h5 class="text-xl font-bold mb-4" id="modalTitle"></h5>
    <img id="modalImage" src="" alt="" class="w-full h-48 object-cover rounded mb-4">
    <p id="modalHarga" class="text-green-600 font-bold mb-4"></p>
    <input type="number" id="jumlahPesanan" class="border rounded w-full mb-4 p-2" value="1" min="1">
    <form id="orderForm" action="{{ route('pesanan.store') }}" method="POST">
      @csrf
      <input type="hidden" name="menu_id" id="menu_id">
      <input type="hidden" name="total_harga" id="total_harga">
      
      <!-- Input Alamat -->
      <input type="text" name="alamat" id="alamat" class="border rounded w-full mb-4 p-2" placeholder="Masukkan Alamat Pengantaran" required>

      <button type="submit" class="bg-green-600 w-full text-white rounded py-2 font-semibold">
        Tambahkan Pesanan
      </button>
    </form>
    <button onclick="document.getElementById('orderModal').classList.add('hidden')" class="absolute top-2 right-2 text-gray-500 hover:text-black">✖️</button>
  </div>
</div>
@endauth
