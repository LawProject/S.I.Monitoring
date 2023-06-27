<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserOrganisasiController extends Controller
{
    public function index()
    {
        $users = User::role('organisasi')->get();
        return view('admin.userOrganisasi.index', ['users' => $users]);
    }
    public function createorganisasi()
    {
        return view('admin.userOrganisasi.tambahorg');
    }
    public function tambah(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->nim = $request->nim;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $user->assignRole('organisasi');

        return redirect()->route('admin.userOrgansiasi')->with('success', 'Pengguna organisasi berhasil ditambahkan');
    }
}
