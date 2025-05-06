@extends('layouts.admin') {{-- atau layout milikmu --}}

@section('content')
<div class="container">
    <h2>Daftar Pengguna</h2>
    
    {{-- Panggil komponen dan kirim data --}}
    <x-user-table :users="$users" />
</div>
@endsection
