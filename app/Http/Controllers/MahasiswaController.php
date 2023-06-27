<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MahasiswaExport;
use App\Imports\MahasiswaImport;
use PDF;
use Maatwebsite\Excel\Excel as ExcelExcel;

class MahasiswaController extends Controller
{


    public function index(Request $request)
    {
        $keyword = $request->input('cari');
        $data = Mahasiswa::when($keyword, function ($query, $keyword) {
            $query->where('namamhs', 'like', "%$keyword%")
                ->orWhere('nim', 'like', "%$keyword%")
                ->orWhere('programstudi', 'like', "%$keyword%")
                ->orWhere('nik', 'like', "%$keyword%")
                ->orWhere('jenisbeasiswa', 'like', "%$keyword%");
        })->paginate(10);
        $data->load('kegiatans');
        return view('admin.mahasiswa.datamahasiswa', compact('data'));
    }
    // public function getStatusAktif($mahasiswa)
    // {
    //     $uploads = $mahasiswa->kegiatans()
    //         ->where('created_at', '>=', now()->subMonths(6))
    //         ->count();

    //     return $uploads >= 2 ? 'aktive' : 'tidak_aktive';
    // }
    public function tambahmhs()
    {
        return view('admin.mahasiswa.tambahmhs');
    }
    public function tambah(Request $request)
    {
        $this->validate($request, [
            'namamhs' => 'required|min:7|max:25',
            'nim' => 'required|min:8|max:8',
        ]);

        Mahasiswa::create($request->all());

        Session::flash('message', 'Data berhasil Update');
        Session::flash('alert-type', 'success');
        return redirect()->route('admin.mahasiswa');
    }

    public function tampildatamhs($id)
    {
        $data = Mahasiswa::find($id);
        // dd($data);

        return view('admin.mahasiswa.ubahdata', compact('data'));
    }
    public function updatemhs(Request $request, $id)
    {
        $data = Mahasiswa::find($id);
        $data->update($request->all());

        Session::flash('message', 'Data berhasil Update');
        return redirect()->route('admin.mahasiswa');
    }
    public function deletemhs($id)
    {
        $data = Mahasiswa::find($id);
        $data->delete();
        return redirect()->route('admin.mahasiswa');
    }
    public function eksportpdf()
    {
        $data = Mahasiswa::all();

        view()->share('data', $data);
        $pdf = PDF::loadview('admin.mahasiswa.datamahasiswa-pdf');
        return $pdf->download('data.pdf');
    }
    public function eksportexcel()
    {
        return Excel::download(new MahasiswaExport, 'datamahasiswa.xlsx');
    }

    public function importexcel(Request $request)
    {
        Excel::import(new MahasiswaImport, $request->file('file'));
        return redirect()->back();
    }
}
