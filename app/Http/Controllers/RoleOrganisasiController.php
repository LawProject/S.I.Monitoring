<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KegiatanOrganisasi;
use Illuminate\Support\Facades\Auth;

class RoleOrganisasiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $logKeg = KegiatanOrganisasi::where('user_id', $user->id)->get();
        $foto_kegiatan = KegiatanOrganisasi::where('user_id', $user->id)->where('foto_kegiatan')->count();

        return view('organisasi.dashboard-org', compact('logKeg', 'foto_kegiatan'));
    }
    public function kegiatanorg()
    {
        $user = Auth::user();

        $kegiatanOrganisasi = KegiatanOrganisasi::where('user_id', $user->id)->get();
        return view('organisasi.kegiatan-org', compact('kegiatanOrganisasi'));
    }
    public function upload()
    {
        return view('organisasi.uploadkegiatanorg');
    }
    public function tambahKegiatanorg(Request $request)
    {
        $user = Auth::user();

        $data = new KegiatanOrganisasi($request->all());
        $data->user_id = $user->id;

        if ($request->hasFile('foto_kegiatan')) {
            $request->file('foto_kegiatan')->move('fotokegiatan-org/', $request->file('foto_kegiatan')->getClientOriginalName());
            $data->foto_kegiatan = $request->file('foto_kegiatan')->getClientOriginalName();
        }
        $data->save();
        return redirect()->route('organisasi.kegiatanorg')->with('success', 'Data Berhasil di Tambahkan');
    }
}
