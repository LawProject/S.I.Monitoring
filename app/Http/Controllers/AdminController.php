<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\KegiatanOrganisasi;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Organisasi;

class AdminController extends Controller
{
    public function index()
    {
        $penggunaTeratas = User::role('organisasi')->has('kegiatanOrganisasi')->withCount('kegiatanOrganisasi')->orderBy('kegiatan_organisasi_count', 'desc')->take(3)->get();
        $labelsPengguna = $penggunaTeratas->pluck('name');
        $dataPengguna = $penggunaTeratas->pluck('kegiatan_organisasi_count');

        $unggulan = Mahasiswa::where('jenisbeasiswa', 'Unggulan')->count();
        $berdikari = Mahasiswa::where('jenisbeasiswa', 'Berdikari')->count();
        $kipkuliah = Mahasiswa::where('jenisbeasiswa', 'KipKuliah')->count();
        $bsi = Mahasiswa::where('jenisbeasiswa', 'BSI')->count();
        $kegiatan = Kegiatan::select('jenis_kegiatan', DB::raw('COUNT(*) as count'))
            ->groupBy('jenis_kegiatan')
            ->get();
        $topMahasiswa = User::select('users.name as nama_mahasiswa', DB::raw('COUNT(kegiatans.id) as count'))
            ->join('kegiatans', 'users.id', '=', 'kegiatans.user_id')
            ->groupBy('users.name')
            ->orderByDesc('count')
            ->limit(10)
            ->get();
        $topOrganisasi = User::whereHas('kegiatanOrganisasi') // Hanya ambil pengguna dengan kegiatan organisasi
            ->withCount('kegiatanOrganisasi') // Menghitung jumlah kegiatan organisasi untuk setiap pengguna
            ->orderBy('kegiatan_organisasi_count', 'desc') // Urutkan berdasarkan jumlah kegiatan secara menurun
            ->limit(3) // Ambil 3 organisasi teratas
            ->get();

        return view('admin.welcome', compact('unggulan', 'berdikari', 'kipkuliah', 'bsi', 'kegiatan', 'topMahasiswa', 'topOrganisasi'));
    }
    public function kegiatan()
    {
        $data = Kegiatan::paginate(5);
        return view('admin.kegiatanmhs.index', compact('data'));
    }
    public function kegiatanorg()
    {
        $data = KegiatanOrganisasi::paginate(5);
        return view('admin.kegiatanorg.index', compact('data'));
    }
    public function profile()
    {
        $admin = Auth::user();
        return view('admin.profile', compact('admin'));
    }
}
