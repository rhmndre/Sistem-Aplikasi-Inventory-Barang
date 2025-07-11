<?php

namespace App\Http\Controllers;

use App\Models\ManajemenUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManajemenUserController extends Controller
{
    public function index()
    {
        $users = ManajemenUser::all();
        return view('manajemenuser.index', compact('users'));
    }

    public function create()
    {
        return view('manajemenuser.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_user' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:manajemen_users,email',
            'password' => 'required|string|min:8|confirmed',
            'hak_akses' => 'required|string|in:superadmin,admin_barang,kepala_gudang',
        ]);

        ManajemenUser::create([
            'nama_user' => $request->nama_user,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'hak_akses' => $request->hak_akses,
        ]);

        return redirect()->route('superadmin.manajemenuser.index')
            ->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = ManajemenUser::findOrFail($id);
        return view('manajemenuser.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_user' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:manajemen_users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'hak_akses' => 'required|string|in:superadmin,admin_barang,kepala_gudang',
        ]);

        $user = ManajemenUser::findOrFail($id);
        
        $data = [
            'nama_user' => $request->nama_user,
            'email' => $request->email,
            'hak_akses' => $request->hak_akses,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('superadmin.manajemenuser.index')
            ->with('success', 'User berhasil diupdate!');
    }

    public function destroy($id)
    {
        $user = ManajemenUser::findOrFail($id);
        $user->delete();
        return redirect()->route('superadmin.manajemenuser.index')
            ->with('success', 'User berhasil dihapus!');
    }
}
