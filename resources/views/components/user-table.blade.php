<table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg overflow-hidden">
    <thead class="bg-gray-800 text-white">
        <tr>
            <th class="px-6 py-3 text-left">ID</th>
            <th class="px-6 py-3 text-left">Nama</th>
            <th class="px-6 py-3 text-left">Email</th>
            <th class="px-6 py-3 text-left">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr class="border-t hover:bg-gray-100 transition-all duration-200">
            <td class="px-6 py-4 text-gray-800">{{ $user->id }}</td>
            <td class="px-6 py-4 text-gray-800">{{ $user->name }}</td>
            <td class="px-6 py-4 text-gray-800">{{ $user->email }}</td>
            <td class="px-6 py-4">
                <!-- Form untuk menghapus user -->
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus user ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-all duration-200">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
