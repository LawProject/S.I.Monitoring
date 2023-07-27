<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KegiatanOrganisasi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RoleOrganisasiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $organisasi = $user->organisasi; // Mengambil data organisasi terkait user

        $logKeg = KegiatanOrganisasi::where('user_id', $user->id)->get();
        $foto_kegiatan = KegiatanOrganisasi::where('user_id', $user->id)->where('foto_kegiatan')->count();

        return view('organisasi.dashboard-org', compact('logKeg', 'foto_kegiatan', 'organisasi'));
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
        // $data->organisasi_id = $user->organisasi_id;
        if ($request->hasFile('foto_kegiatan')) {
            $request->file('foto_kegiatan')->move('fotokegiatan-org/', $request->file('foto_kegiatan')->getClientOriginalName());
            $data->foto_kegiatan = $request->file('foto_kegiatan')->getClientOriginalName();
        }
        $organisasi = $user->organisasi;
        $data->organisasi_id = $organisasi->id;
        $data->save();
        return redirect()->route('organisasi.kegiatanorg')->with('success', 'Data Berhasil di Tambahkan');
    }
    public function profil()
    {
        $user = Auth::user();

        return view('organisasi.profile-org', compact('user'));
    }
    public function detailuserOrg($id)
    {
        $kegiatan = KegiatanOrganisasi::findOrFail($id);
        return view('organisasi.detail', compact('kegiatan'));
    }
}
