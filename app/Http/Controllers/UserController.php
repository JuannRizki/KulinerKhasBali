<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Admin: Menampilkan semua user
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    // Admin: Menghapus user berdasarkan ID
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus.');
    }

    // User: Menampilkan form edit profil
    public function edit()
    {
        $user = auth()->user(); // User yang sedang login
        return view('user.edit', compact('user'));
    }

    // User: Menyimpan perubahan profil
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('user.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
