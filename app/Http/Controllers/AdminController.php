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
            ->where('status', true) // Hanya ambil kegiatan yang telah diverifikasi
            ->groupBy('jenis_kegiatan')
            ->get();
        $topMahasiswa = User::select('users.name as nama_mahasiswa', DB::raw('COUNT(kegiatans.id) as count'))
            ->where('status', true) // Hanya ambil pengguna yang telah diverifikasi
            ->join('kegiatans', 'users.id', '=', 'kegiatans.user_id')
            ->groupBy('users.name')
            ->orderByDesc('count')
            ->limit(10)
            ->get();
        $topOrganisasi = User::whereHas('kegiatanOrganisasi') // Hanya ambil pengguna dengan kegiatan organisasi
            ->withCount([
                'kegiatanOrganisasi' => function ($query) {
                    $query->where('status_verifikasi', true);
                }
            ]) // Menghitung jumlah kegiatan organisasi untuk setiap pengguna
            ->orderBy('kegiatan_organisasi_count', 'desc') // Urutkan berdasarkan jumlah kegiatan secara menurun
            ->limit(3) // Ambil 3 organisasi teratas
            ->get();

        return view('admin.welcome', compact('unggulan', 'berdikari', 'kipkuliah', 'bsi', 'kegiatan', 'topMahasiswa', 'topOrganisasi'));
    }
    public function kegiatan()
    {
        $data = Kegiatan::paginate(5);
        $status = Kegiatan::where('status', false)->get();
        return view('admin.kegiatanmhs.index', compact('data', 'status'));
    }
    public function detailKegiatan($id)
    {
        $data = Kegiatan::findOrFail($id);
        return view('admin.kegiatanmhs.detailkegiatanMhas', compact('data'));
    }
    public function deleteKegiatan($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->delete();

        return redirect()->back()->with('success', 'Kegiatan berhasil dihapus');
    }

    public function kegiatanorg()
    {
        $data = KegiatanOrganisasi::paginate(5);
        $status = KegiatanOrganisasi::where('status_verifikasi', false)->get();
        return view('admin.kegiatanorg.index', compact('data', 'status'));
    }
    public function detailKegiatanOrg($id)
    {
        $kegiatan = KegiatanOrganisasi::findOrFail($id);
        return view('admin.kegiatanorg.detailkegiatanOrg', compact('kegiatan'));
    }
    public function deleteKegiatanOrg($id)
    {
        $kegiatan = KegiatanOrganisasi::findOrFail($id);
        $kegiatan->delete();

        return redirect()->back()->with('success', 'Kegiatan berhasil dihapus');
    }
    public function profile()
    {
        $admin = Auth::user();
        return view('admin.profile', compact('admin'));
    }
    public function verifikasiKegiatan($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->status = 1; // Set status verifikasi kegiatan menjadi "1"
        $kegiatan->save();

        return redirect()->back()->with('success', 'Kegiatan berhasil diverifikasi');
    }
    public function verify($id)
    {
        $kegiatan = KegiatanOrganisasi::findOrFail($id);
        $kegiatan->status_verifikasi = true;
        $kegiatan->save();

        // Ambil organisasi terkait
        $organisasi = $kegiatan->organisasi;

        // Perbarui status organisasi
        $jumlahKegiatan = $organisasi->kegiatan_organisasis()
            ->where('status_verifikasi', true)
            ->count();

        if ($jumlahKegiatan >= 2) {
            $organisasi->status = 'aktif';
        } else {
            $organisasi->status = 'tidak_aktif';
        }

        $organisasi->save();

        return redirect()->back()->with('success', 'Kegiatan organisasi berhasil diverifikasi');
    }

    // public function tolakKegiatan($id)
    // {
    //     $kegiatan = Kegiatan::findOrFail($id);
    //     $kegiatan->status = 0; // Set status kegiatan menjadi "2" (Ditolak)
    //     $kegiatan->save();

    //     return redirect()->back()->with('success', 'Kegiatan telah ditolak');
    // }
}
