<?php

namespace App\Http\Controllers;

use  App\Models\Organisasi;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use PDF;

class OrganisasiController extends Controller
{
    public function index()
    {
        $data = Organisasi::all();

        return view('admin.organisasi.dataorganisasi', compact('data'));
    }
    public function updateStatus(Organisasi $organisasi)
    {
        $jumlahKegiatan = $organisasi->kegiatan_organisasis()
            ->where('status_verifikasi', true) // Hanya menghitung kegiatan yang telah dikonfirmasi
            ->count();

        if ($jumlahKegiatan >= 2) {
            $organisasi->status = 'aktif';
        } else {
            $organisasi->status = 'tidak_aktif';
        }

        $organisasi->save();
    }
    public function tambahorganisasi()
    {
        return view('admin.organisasi.tambahorgan');
    }
    public function tambahorg(Request $request)
    {
        $organisasi = new Organisasi();
        $organisasi->namaorganisasi = $request->namaorganisasi;
        $organisasi->nim = $request->nim;
        $organisasi->pembina = $request->pembina;
        $organisasi->ketua = $request->ketua;
        $organisasi->periode = $request->periode;
        // Atur default status 'tidak_aktif'
        $organisasi->status = 'tidak_aktif';
        // Jika terdapat 'nim' yang dikirimkan melalui permintaan
        if ($request->has('nim')) {
            // Cari pengguna yang terkait dengan 'nim' tersebut
            $user = User::where('nim', $request->nim)->first();

            if ($user) {
                $organisasi->user_id = $user->id;
            }
        }

        $organisasi->save();

        return redirect()->route('admin.organisasi')->with('success', 'Data Berhasil di Tambahkan');
    }



    public function tampildataorg($id)
    {
        $data = Organisasi::find($id);
        // dd($data);
        return view('admin.organisasi.ubahdataorg', compact('data'));
    }
    public function updateorg(Request $request, $id)
    {
        $data = Organisasi::find($id);
        $data->update($request->all());
        $data->updateStatus(); // Memanggil metode updateStatus()
        return redirect()->route('admin.organisasi')->with('success', 'Data Berhasil di Update');
    }

    public function deleteorg($id)
    {
        $data = Organisasi::find($id);
        $data->delete();
        return redirect()->route('admin.organisasi');
    }
    public function eksportpdforg()
    {
        $data = Organisasi::all();
        return view('admin.organisasi.dataorganisasi-pdf', compact('data'));
    }
}
