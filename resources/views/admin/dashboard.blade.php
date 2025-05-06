
@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-semibold text-gray-800 flex items-center mb-4">
        <i class="fas fa-tachometer-alt mr-2 text-gray-700"></i> Dashboard
    </h2>
    <hr class="mb-6">

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <!-- Kuliner -->
        <div class="bg-blue-200 text-gray-800 rounded-xl p-6 shadow hover:shadow-lg hover:scale-105 transition">
            <h3 class="text-xl font-semibold mb-2 flex items-center">
                <i class="fas fa-utensils mr-2"></i> Kuliner
            </h3>
            <p class="text-3xl font-bold">{{ $totalMenus }}</p>
        </div>

        <!-- Tamu -->
        <div class="bg-green-200 text-gray-800 rounded-xl p-6 shadow hover:shadow-lg hover:scale-105 transition">
            <h3 class="text-xl font-semibold mb-2 flex items-center">
                <i class="fas fa-users mr-2"></i> Tamu
            </h3>
            <p class="text-3xl font-bold">{{ $totalUsers }}</p>
        </div>

        <!-- Pesanan -->
        <div class="bg-yellow-200 text-gray-800 rounded-xl p-6 shadow hover:shadow-lg hover:scale-105 transition">
            <h3 class="text-xl font-semibold mb-2 flex items-center">
                <i class="fas fa-shopping-cart mr-2"></i> Pesanan
            </h3>
            <p class="text-3xl font-bold">{{ $totalPesanans }}</p>


@endsection

</body>
</html>

