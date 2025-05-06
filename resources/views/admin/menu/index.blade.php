@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Daftar Menu</h2>
        <a href="{{ route('menu.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition-colors duration-200">+ Tambah Menu</a>
    </div>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 mb-6 rounded-lg shadow-md">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg overflow-hidden">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="px-6 py-3 text-left">No</th>
                <th class="px-6 py-3 text-left">Nama</th>
                <th class="px-6 py-3 text-left">Harga</th>
                <th class="px-6 py-3 text-left">Gambar</th>
                <th class="px-6 py-3 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menus as $menu)
            <tr class="border-t hover:bg-gray-100 transition-all duration-200">
                <td class="px-6 py-4 text-gray-800">{{ $loop->iteration }}</td>
                <td class="px-6 py-4 text-gray-800">{{ $menu->nama }}</td>
                <td class="px-6 py-4 text-gray-800">Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                <td class="px-6 py-4 text-gray-800">
                    @if($menu->gambar)
                        <img src="{{ asset('images/'.$menu->gambar) }}" class="w-24 h-24 object-cover rounded">
                    @else
                        <span class="text-gray-500 italic">Tidak ada</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="space-x-2">
                        <a href="{{ route('menu.edit', $menu->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition-colors duration-200">Edit</a>
                        <form action="{{ route('menu.destroy', $menu->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-all duration-200">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
