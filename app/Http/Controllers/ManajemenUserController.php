<?php

namespace App\Http\Controllers;

use App\Models\ManajemenUser;
use Illuminate\Http\Request;

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
            'username' => 'required|string|max:255|unique:manajemen_users,username',
            'hak_akses' => 'required|string|max:255',
        ]);
        ManajemenUser::create($request->all());
        return redirect()->route('manajemenuser.index')->with('success', 'User berhasil ditambahkan!');
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
            'username' => 'required|string|max:255|unique:manajemen_users,username,' . $id,
            'hak_akses' => 'required|string|max:255',
        ]);
        $user = ManajemenUser::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('manajemenuser.index')->with('success', 'User berhasil diupdate!');
    }

    public function destroy($id)
    {
        $user = ManajemenUser::findOrFail($id);
        $user->delete();
        return redirect()->route('manajemenuser.index')->with('success', 'User berhasil dihapus!');
    }
}
