<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function showContactForm()
    {
        return view('contact.index');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'pesan' => 'required'
        ]);

        // Simpan ke database atau kirim email (sementara hanya menampilkan pesan sukses)
        return back()->with('success', 'Pesan Anda telah dikirim!');
    }
}
