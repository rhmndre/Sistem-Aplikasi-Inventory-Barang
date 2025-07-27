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

        // Hash password once
        $hashedPassword = Hash::make($request->password);

        $user = ManajemenUser::create([
            'nama_user' => $request->nama_user,
            'email' => $request->email,
            'password' => $hashedPassword,
            'hak_akses' => $request->hak_akses,
        ]);

        // Convert hak_akses to role format
        $roleMap = [
            'superadmin' => 'superadmin',
            'admin_barang' => 'adminbarang',
            'kepala_gudang' => 'kepalagudang'
        ];

        // Create corresponding User record for authentication
        \App\Models\User::create([
            'name' => $request->nama_user,
            'email' => $request->email,
            'password' => $hashedPassword,  // Use the same hash
            'role' => $roleMap[$request->hak_akses],
            'email_verified_at' => now(),  // Mark as verified
        ]);

        return redirect()->route('superadmin.manajemenuser.index')
            ->with('success', 'User berhasil ditambahkan dan dapat login dengan credentials yang diberikan!');
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

        $manajemenUser = ManajemenUser::findOrFail($id);
        
        $data = [
            'nama_user' => $request->nama_user,
            'email' => $request->email,
            'hak_akses' => $request->hak_akses,
        ];

        $hashedPassword = null;
        if ($request->filled('password')) {
            $hashedPassword = Hash::make($request->password);
            $data['password'] = $hashedPassword;
        }

        $manajemenUser->update($data);

        // Convert hak_akses to role format
        $roleMap = [
            'superadmin' => 'superadmin',
            'admin_barang' => 'adminbarang',
            'kepala_gudang' => 'kepalagudang'
        ];

        // Update corresponding User record
        $user = \App\Models\User::where('email', $manajemenUser->email)->first();
        if ($user) {
            $userData = [
                'name' => $request->nama_user,
                'email' => $request->email,
                'role' => $roleMap[$request->hak_akses],
            ];

            if ($hashedPassword) {
                $userData['password'] = $hashedPassword;  // Use the same hash
            }

            $user->update($userData);
        }

        return redirect()->route('superadmin.manajemenuser.index')
            ->with('success', 'User berhasil diupdate!');
    }

    public function destroy($id)
    {
        $manajemenUser = ManajemenUser::findOrFail($id);
        
        // Delete corresponding User record
        \App\Models\User::where('email', $manajemenUser->email)->delete();
        
        $manajemenUser->delete();
        
        return redirect()->route('superadmin.manajemenuser.index')
            ->with('success', 'User berhasil dihapus!');
    }
}
