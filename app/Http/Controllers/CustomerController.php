<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = [
            ['id' => 1, 'nama' => 'riansyah', 'email' => 'riansyah@gmail.com'],
            ['id' => 2, 'nama' => 'gofur', 'email' => 'gofur@gmail.com'],
            ['id' => 3, 'nama' => 'Juan', 'email' => 'juan@gmail.com'],
            ['id' => 4, 'nama' => 'Nafisah', 'email' => 'nafisah@gmail.com'],
        
        ];

        return view('customer', compact('customers'));
    }
}
