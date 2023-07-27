<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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

        return view('user.dashboard', compact('akademik', 'organisasi', 'logKeg', 'YHC', 'polhas', 'prodi', 'mudabanua', 'donatur', 'user'));
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
        $username = $user->username; // Mengambil username dari user yang sedang login

        $data = new Kegiatan($request->all());
        $data->user_id = $user->id;
        $data->nama = $username; // Mengisi kolom "nama" dengan username
        $data->status = 0; // Set status kegiatan menjadi "0" (belum diverifikasi)

        if ($request->hasFile('foto')) {
            $request->file('foto')->move('fotokegiatan/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
        }

        // Tambahkan kode berikut untuk menentukan nilai 'mahasiswa_id'
        $mahasiswa = $user->mahasiswa;
        $data->mahasiswa_id = $mahasiswa->id;

        $data->save();

        return redirect()->route('user.kegiatanmhs')->with('success', 'Data Berhasil di Tambahkan');
    }



    public function show($id)
    {
        $data = Kegiatan::findOrFail($id);
        return view('user.detailkegiatan', ['data' => $data]);
    }
    public function profile()
    {
        $user = Auth::user();
        $grafikuser = Kegiatan::select('jenis_kegiatan as jenis',  DB::raw('COUNT(kegiatans.id) as count'))
            ->where('user_id', $user->id)
            ->groupBy('jenis_kegiatan')
            ->get();
        // dd($userActivities);
        return view('user.profile', compact('user', 'grafikuser'));
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input sesuai kebutuhan
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk foto (opsional)
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Periksa apakah ada file foto yang diunggah
        if ($request->hasFile('foto')) {
            // Menghapus foto lama (jika ada)
            if ($user->foto) {
                $fotoPath = public_path('foto/' . $user->foto);
                if (file_exists($fotoPath)) {
                    unlink($fotoPath);
                }
            }

            // Mengunggah foto baru
            $foto = $request->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('foto'), $fotoName);

            // Simpan nama file foto baru ke dalam atribut 'foto' pada model User
            $user->foto = $fotoName;
        }

        // Periksa apakah ada perubahan password yang dimasukkan
        $password = $request->input('password');
        if (!empty($password)) {
            $user->password = Hash::make($password);
        }

        $user->save();

        return redirect()->route('user.user.index')->with('success', 'Profil berhasil diperbarui');
    }
}
