<?php

namespace App\Http\Controllers\Admin;

use App\Events\MahasiswaRegistered;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::role('user')->get();
        return view('admin.user.index', ['users' => $users]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.tambahuser');
    }
    public function tambah(Request $request)
    {

        // User::create($request->all());
        // return redirect()->route('admin.user.index')->with('success', 'Data Berhasil di Tambahkan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|string',
                'nim' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required'
            ]
        );
        $user = new User();
        $user->name = $request->name;
        $user->nim = $request->nim;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $nim = $request->nim;
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();

        if ($mahasiswa) {
            // Jika ditemukan mahasiswa dengan NIM yang cocok
            $mahasiswa->user_id = $user->id;
            $mahasiswa->save();
        }
        if ($request->role == 'organisasi') {
            $user->assignRole('organisasi');
        } else {
            $user->assignRole('user');
        }

        // Mengarahkan admin ke halaman yang sesuai
        if ($request->role == 'organisasi') {
            return redirect()->route('admin.tambahorganisasi')->with('success', 'Pengguna organisasi berhasil ditambahkan');
        } else {
            return redirect()->route('admin.user.index')->with('success', 'Pengguna berhasil ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
