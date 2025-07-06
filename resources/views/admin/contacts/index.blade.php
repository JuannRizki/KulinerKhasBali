@extends('layouts.admin')

@section('title', 'Contact Messages')

@section('content')
<div class="container py-4">
    <div class="flex items-center gap-2 mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 10.5a8.38 8.38 0 01-.9 3.8c-.6 1.2-1.5 2.3-2.6 3.1-1.1.8-2.4 1.3-3.8 1.3s-2.7-.5-3.8-1.3c-1.1-.8-2-1.9-2.6-3.1A8.38 8.38 0 013 10.5C3 6.4 7.03 3 12 3s9 3.4 9 7.5z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M16 10h.01" />
        </svg>
        <h2 class="text-xl font-bold">User Contact Messages</h2>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border border-gray-300 rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">Name</th>
                <th class="p-2 border">Email</th>
                <th class="p-2 border">Message</th>
                <th class="p-2 border">Reply</th>
                <th class="p-2 border">Date</th>
                <th class="p-2 border">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kontaks as $kontak)
                <tr class="border-t">
                    <td class="p-2">{{ $kontak->nama }}</td>
                    <td class="p-2">{{ $kontak->email }}</td>
                    <td class="p-2">{{ $kontak->pesan }}</td>
                    <td class="p-2">
                        @if($kontak->balasan)
                            <div class="bg-green-50 p-2 rounded text-sm text-green-700">{{ $kontak->balasan }}</div>
                        @else
                            <span class="text-gray-400 text-sm">No reply yet</span>
                        @endif
                    </td>
                    <td class="p-2 text-sm text-gray-600">{{ $kontak->created_at->format('d M Y H:i') }}</td>
                    <td class="p-2">
                        <form action="{{ route('admin.balasPesan', $kontak->id) }}" method="POST" class="mb-2">
                            @csrf
                            @method('PUT')
                            <textarea name="balasan" rows="2" placeholder="Write reply..." class="border p-1 w-full mb-1">{{ $kontak->balasan }}</textarea>
                            <button type="submit" class="bg-indigo-500 text-white px-3 py-1 rounded">Reply</button>
                        </form>

                        <form action="{{ route('admin.hapusPesan', $kontak->id) }}" method="POST" onsubmit="return confirm('Delete this message?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-4 text-center text-gray-500">No messages found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
