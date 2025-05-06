@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-xl mx-auto bg-white border border-gray-300 rounded-lg shadow-lg">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Menu: {{ $menu->nama }}</h2>

    <form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-4">
            <!-- Nama Menu -->
            <div>
                <label for="nama" class="block text-gray-800 font-medium">Nama Menu</label>
                <input type="text" id="nama" name="nama" value="{{ $menu->nama }}" class="w-full border border-gray-300 text-gray-800 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Harga -->
            <div>
                <label for="harga" class="block text-gray-800 font-medium">Harga</label>
                <input type="number" id="harga" name="harga" value="{{ $menu->harga }}" class="w-full border border-gray-300 text-gray-800 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="deskripsi" class="block text-gray-800 font-medium">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="3" class="w-full border border-gray-300 text-gray-800 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $menu->deskripsi }}</textarea>
            </div>

            <!-- Gambar -->
            <div>
                <label for="gambar" class="block text-gray-800 font-medium">Gambar (opsional)</label>
                @if($menu->gambar)
                    <div class="mb-4">
                        <img src="{{ asset('images/' . $menu->gambar) }}" class="w-24 h-24 object-cover rounded mb-2" alt="Menu Image">
                    </div>
                @endif
                <input type="file" id="gambar" name="gambar" accept="image/*" class="w-full border border-gray-300 text-gray-800 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end space-x-2">
                <a href="{{ route('menu.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition">Batal</a>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">Perbarui</button>
            </div>
        </div>
    </form>
</div>
@endsection
