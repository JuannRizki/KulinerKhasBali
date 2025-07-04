@extends('layouts.admin') {{-- atau layout milikmu --}}

@section('content')
<div class="container">
    <div class="flex items-center gap-2 mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1112 21a9 9 0 01-6.879-3.196z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <h2 class="text-2xl font-bold text-gray-800">Users</h2>
    </div>
    {{-- Call component and pass data --}}
    <x-user-table :users="$users" />
</div>
@endsection
