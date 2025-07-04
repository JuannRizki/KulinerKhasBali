@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-xl mx-auto bg-white border border-gray-300 rounded-lg shadow-lg">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Add New Menu</h2>

    <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Menu Name -->
        <div>
            <label for="nama" class="block text-gray-800 font-medium">Menu Name</label>
            <input type="text" name="nama" id="nama" class="w-full border border-gray-300 text-gray-800 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Price -->
        <div>
            <label for="harga" class="block text-gray-800 font-medium">Price</label>
            <input type="number" name="harga" id="harga" class="w-full border border-gray-300 text-gray-800 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Stock -->
        <div>
            <label for="stok" class="block text-gray-800 font-medium">Stock</label>
            <input type="number" name="stok" id="stok" min="0" class="w-full border border-gray-300 text-gray-800 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Description -->
        <div>
            <label for="deskripsi" class="block text-gray-800 font-medium">Description</label>
            <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full border border-gray-300 text-gray-800 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>

        <!-- Image -->
        <div>
            <label for="gambar" class="block text-gray-800 font-medium">Image (optional)</label>
            <input type="file" name="gambar" id="gambar" accept="image/*" class="w-full border border-gray-300 text-gray-800 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-2">
            <a href="{{ route('admin.menu.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Save</button>
        </div>
    </form>
</div>
@endsection
