@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-xl mx-auto bg-white border border-gray-300 rounded-lg shadow-lg">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tambah Menu Baru</h2>

    <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Nama Menu -->
        <div>
            <label for="nama" class="block text-gray-800 font-medium">Nama Menu</label>
            <input type="text" name="nama" id="nama" class="w-full border border-gray-300 text-gray-800 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Harga -->
        <div>
            <label for="harga" class="block text-gray-800 font-medium">Harga</label>
            <input type="number" name="harga" id="harga" class="w-full border border-gray-300 text-gray-800 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Deskripsi -->
        <div>
            <label for="deskripsi" class="block text-gray-800 font-medium">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full border border-gray-300 text-gray-800 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>

        <!-- Gambar -->
        <div>
            <label for="gambar" class="block text-gray-800 font-medium">Gambar (opsional)</label>
            <input type="file" name="gambar" id="gambar" accept="image/*" class="w-full border border-gray-300 text-gray-800 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Tombol Aksi -->
        <div class="flex justify-end space-x-2">
            <a href="{{ route('menu.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Simpan</button>
        </div>
    </form>
</div>
@endsection
