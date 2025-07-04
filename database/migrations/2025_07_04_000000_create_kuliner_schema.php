<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Users
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->text('alamat')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken()->nullable();
            $table->timestamps();
            $table->string('role')->default('user');
            $table->string('profile_picture')->nullable();
        });

        // Menus
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->integer('harga');
            $table->string('gambar')->nullable();
            $table->timestamps();
            $table->integer('stok')->default(0);
        });

        // Pesanans
        Schema::create('pesanans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('order_id', 100)->nullable();
            $table->integer('total_harga');
            $table->timestamps();
            $table->string('status', 50)->default('pending');
            $table->decimal('rating', 2, 1)->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->string('snap_token')->nullable();
            $table->string('pembayaran', 100)->nullable();
            $table->string('bukti_transfer')->nullable();
            $table->enum('status_pembayaran', ['pending', 'dibayar'])->default('pending');
            $table->string('alamat', 255)->nullable();
            $table->foreign('user_id')->references('id')->on('users');
        });

        // Pesanan Items
        Schema::create('pesanan_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pesanan_id');
            $table->unsignedBigInteger('menu_id');
            $table->integer('jumlah');
            $table->tinyInteger('rating')->unsigned()->nullable();
            $table->integer('harga_satuan');
            $table->timestamps();
            $table->foreign('pesanan_id')->references('id')->on('pesanans')->onDelete('cascade');
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
        });

        // Kontaks
        Schema::create('kontaks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('email');
            $table->text('pesan');
            $table->timestamps();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Carts
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('menu_id');
            $table->integer('jumlah')->default(1);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
        Schema::dropIfExists('kontaks');
        Schema::dropIfExists('pesanan_items');
        Schema::dropIfExists('pesanans');
        Schema::dropIfExists('menus');
        Schema::dropIfExists('users');
    }
};
