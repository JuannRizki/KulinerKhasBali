@extends('layouts.admin') 
@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3>Admin Lobby</h3>
        </div>
        <div class="card-body">
            <p>Selamat datang di halaman Admin Lobby!</p>
            <p>Silakan pilih menu yang ingin Anda kelola.</p>
            <div class="row">
                <div class="col-md-4">
                    <a href="{{ route('users.index') }}" class="btn btn-success btn-block">Kelola Pengguna</a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('orders.index') }}" class="btn btn-warning btn-block">Kelola Pesanan</a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('products.index') }}" class="btn btn-info btn-block">Kelola Produk</a>
                </div>
            </div>
            <hr>
            <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
        </div>
    </div>
</div>
@endsection