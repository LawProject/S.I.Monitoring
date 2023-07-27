<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;

class KegiatanMahasiswaController extends Controller
{
    public function index()
    {
        $data = Kegiatan::all();
        return view('user.kegiatanmhs', compact('data'));
    }

    public function verifikasiKegiatan($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->verifikasi = 1; // Set status verifikasi kegiatan menjadi "1"
        $kegiatan->save();

        return redirect()->back()->with('success', 'Kegiatan berhasil diverifikasi');
    }
}
