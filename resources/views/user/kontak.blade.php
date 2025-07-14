@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-semibold text-center mb-6">Contact Us</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('kontak.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md max-w-md mx-auto mb-8">
            @csrf
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" 
                       id="nama" 
                       name="nama" 
                       value="{{ Auth::user()->name }}" 
                       class="mt-1 w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 bg-gray-100"
                       readonly>
                @error('nama')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ Auth::user()->email }}" 
                       class="mt-1 w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 bg-gray-100"
                       readonly>
                @error('email')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="pesan" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea id="pesan" name="pesan" rows="3" class="mt-1 w-full p-2 border rounded focus:ring-2 focus:ring-blue-500" required></textarea>
                @error('pesan')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="w-full py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:ring-2 focus:ring-blue-500">
                Send Message
            </button>
        </form>

        <!-- Displaying User Messages -->
        <div class="max-w-2xl mx-auto">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Your Messages</h2>

            @forelse($kontaks as $kontak)
                <div class="bg-white border border-gray-300 rounded-lg p-4 mb-6 shadow-sm">
                    <div class="flex justify-between items-center mb-2">
                        <p class="font-medium text-gray-700">{{ $kontak->nama }}</p>
                        <p class="text-sm text-gray-500">{{ $kontak->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <p class="text-gray-800">{{ $kontak->pesan }}</p>

                    @if($kontak->balasan)
                        <div class="mt-4 p-4 border border-green-300 bg-green-50 rounded">
                            <p class="font-semibold text-green-700 mb-1">Admin Reply:</p>
                            <p class="text-green-800">{{ $kontak->balasan }}</p>
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-gray-500">No messages yet.</p>
            @endforelse
        </div>
    </div>
@endsection
