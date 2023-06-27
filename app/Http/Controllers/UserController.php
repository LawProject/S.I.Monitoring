<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $logKeg = Kegiatan::where('user_id', $user->id)->get();
        $akademik = Kegiatan::where('user_id', $user->id)->where('jenis_kegiatan', 'Akademik')->count();
        $organisasi = Kegiatan::where('user_id', $user->id)->where('jenis_kegiatan', 'Organisasi')->count();
        $YHC = Kegiatan::where('user_id', $user->id)->where('jenis_kegiatan', 'YHC')->count();
        $polhas = Kegiatan::where('user_id', $user->id)->where('jenis_kegiatan', 'PoliteknikHasnur')->count();
        $prodi = Kegiatan::where('user_id', $user->id)->where('jenis_kegiatan', 'ProgramStudi')->count();
        $mudabanua = Kegiatan::where('user_id', $user->id)->where('jenis_kegiatan', 'BaktiBanua')->count();
        $donatur = Kegiatan::where('user_id', $user->id)->where('jenis_kegiatan', 'DonaturBeasiswa')->count();

        return view('user.dashboard', compact('akademik', 'organisasi', 'logKeg', 'YHC', 'polhas', 'prodi', 'mudabanua', 'donatur'));
    }

    public function kegiatanmhs()
    {
        $user = Auth::user();
        $data = Kegiatan::where('user_id', $user->id)->get();
        return view('user.kegiatanmhs', compact('data'));
    }

    public function upload()
    {
        return view('user.uploadkegiatanmhs');
    }

    public function tambahKegiatanMhs(Request $request)
    {
        $user = Auth::user();

        $data = new Kegiatan($request->all());
        $data->user_id = $user->id;

        if ($request->hasFile('foto')) {
            $request->file('foto')->move('fotokegiatan/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
        }
        $data->save();

        // // Cek jumlah kegiatan pengguna
        // $jumlahKegiatan = $user->kegiatan()->count();

        // // Perbarui status mahasiswa berdasarkan jumlah kegiatan
        // $mahasiswa = $user->mahasiswa;
        // $mahasiswa->status = ($jumlahKegiatan >= 5) ? 'aktif' : 'tidak aktif';
        // $mahasiswa->save();
        return redirect()->route('user.kegiatanmhs')->with('success', 'Data Berhasil di Tambahkan');
    }
    public function show($id)
    {
        $data = Kegiatan::findOrFail($id);
        return view('user.detailkegiatan', ['data' => $data]);
    }
    public function profile(User $user)
    {
        return view('user.profile', compact('user'));
    }
    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input sesuai kebutuhan
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Periksa apakah ada perubahan password yang dimasukkan
        $password = $request->input('password');
        if (!empty($password)) {
            $user->password = Hash::make($password);
        }

        $user->save();

        return redirect()->route('user.user.index')->with('success', 'Profil berhasil diperbarui');
    }
}
