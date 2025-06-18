@extends('layouts.admin')

@section('title', 'Pesan Kontak')

@section('content')
<div class="container py-4">
    <h2 class="text-xl font-bold mb-4">Daftar Pesan dari Pengguna</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border border-gray-300 rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">Nama</th>
                <th class="p-2 border">Email</th>
                <th class="p-2 border">Pesan</th>
                <th class="p-2 border">Tanggal</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kontaks as $kontak)
                <tr class="border-t">
                    <td class="p-2">{{ $kontak->nama }}</td>
                    <td class="p-2">{{ $kontak->email }}</td>
                    <td class="p-2">{{ $kontak->pesan }}</td>
                    <td class="p-2 text-sm text-gray-600">{{ $kontak->created_at->format('d M Y H:i') }}</td>
                    <td class="p-2">
                        <form action="{{ route('admin.hapusPesan', $kontak->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500">Tidak ada pesan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
