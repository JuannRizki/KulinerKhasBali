@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-6">
    <h2 class="text-2xl font-bold mb-4">Menu Rating Data</h2>

    {{-- Table: Summary of Ratings per Menu --}}
    <table class="table-auto w-full border border-gray-300 mt-4">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border">Menu</th>
                <th class="px-4 py-2 border text-center">Total Ratings</th>
                <th class="px-4 py-2 border text-center">Average</th>
                <th class="px-4 py-2 border text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ratings as $rating)
            <tr>
                <td class="border px-4 py-2">{{ $rating->menu->nama ?? '-' }}</td>
                <td class="border px-4 py-2 text-center">{{ $rating->total_rating }}</td>
                <td class="border px-4 py-2 text-center text-yellow-600 font-bold">
                    ⭐ {{ number_format($rating->average_rating, 1) }}
                </td>
                <td class="border px-4 py-2 text-center">
                    <a href="{{ route('admin.ratings.index', ['menu_id' => $rating->menu_id]) }}" 
                       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                        View
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Table: List of Emails Who Gave Ratings --}}
    @if($menuId && $emailsWithRatings->count())
    <h2 class="text-xl font-bold mt-10 mb-4">Rating Details for Menu:
        <span class="text-blue-600">
            {{ optional($emailsWithRatings->first()->menu)->nama ?? '-' }}
        </span>
    </h2>
    <a href="{{ route('admin.ratings.index') }}" class="text-sm text-gray-600 underline mb-4 inline-block">← Back</a>

    <table class="table-auto w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border">#</th>
                <th class="px-4 py-2 border">Email</th>
                <th class="px-4 py-2 border text-center">Rating</th>
            </tr>
        </thead>
        <tbody>
            @foreach($emailsWithRatings as $item)
            <tr>
                <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                <td class="border px-4 py-2">{{ $item->pesanan->user->email ?? '-' }}</td>
                <td class="border px-4 py-2 text-center text-yellow-600 font-bold">
                    ⭐ {{ $item->rating }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
