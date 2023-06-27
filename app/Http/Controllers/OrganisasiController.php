<?php

namespace App\Http\Controllers;

use  App\Models\Organisasi;
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
    public function tambahorganisasi()
    {
        return view('admin.organisasi.tambahorgan');
    }
    public function tambahorg(Request $request)
    {
        Organisasi::create($request->all());
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
        return redirect()->route('admin.organisasi')->with('success', 'Data Berhasil di Update');
    }
    public function deleteorg($id)
    {
        $data = Organisasi::find($id);
        $data->delete();
        return redirect()->route('admin.organisasi')->with('success', 'Data Berhasil di Dihapus');
    }
    public function eksportpdforg()
    {
        $data = Organisasi::all();

        view()->share('data', $data);
        $pdf = FacadePdf::loadview('admin.organisasi.dataorganisasi-pdf');
        return $pdf->download('data Organisasi.pdf');
    }
}
