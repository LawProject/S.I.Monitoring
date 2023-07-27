<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MahasiswaExport;
use App\Imports\MahasiswaImport;
use Maatwebsite\Excel\Concerns\ToArray;
use PDF;
use Toastr;

use Maatwebsite\Excel\Excel as ExcelExcel;

class MahasiswaController extends Controller
{


    public function index(Request $request)
    {
        $semester = $request->input('semester');
        $keyword = $request->input('cari');

        $data = Mahasiswa::when($semester, function ($query, $semester) {
            return $query->where('semester', $semester);
        })
            ->where(function ($query) use ($keyword) {
                $query->where('namamhs', 'LIKE', "%$keyword%")
                    ->orWhere('nim', 'LIKE', "%$keyword%")
                    ->orWhere('programstudi', 'LIKE', "%$keyword%")
                    ->orWhere('nik', 'LIKE', "%$keyword%")
                    ->orWhere('jenisbeasiswa', 'LIKE', "%$keyword%");
            })
            ->paginate(10);

        return view('admin.mahasiswa.datamahasiswa', compact('data', 'semester'));
    }

    public function updateStatus(Mahasiswa $mahasiswa)
    {
        $jumlahKegiatanVerifikasi = $mahasiswa->kegiatans()->where('status', true)->count();

        if ($jumlahKegiatanVerifikasi >= 2) {
            $mahasiswa->status = 'aktive';
        } else {
            $mahasiswa->status = 'tidak_aktve';
        }

        $mahasiswa->save();
    }


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

        $mahasiswa = Mahasiswa::create($request->all());
        // $this->updateStatus($mahasiswa);
        Session::flash('success', 'Data berhasil Tambahkan');

        return redirect()->route('admin.mahasiswa', compact('mahasiswa'));
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
        $data->update($request->except('status')); // Mengabaikan pembaruan status
        $this->updateStatus($data); // Memanggil fungsi updateStatus()
        Session::flash('message', 'Data berhasil Update');
        return redirect()->route('admin.mahasiswa');
    }
    public function deletemhs($id)
    {
        $data = Mahasiswa::find($id);
        $data->delete();
        Session::flash('success', 'Data berhasil Dihapus', 'Sukses');

        return redirect()->route('admin.mahasiswa');
    }
    public function eksportpdf()
    {
        $data = Mahasiswa::all();
        return view(
            'admin.mahasiswa.datamahasiswa-pdf',
            compact('data')
        );
    }
    public function eksportexcel()
    {
        return Excel::download(new MahasiswaExport, 'datamahasiswa.xlsx');
    }

    public function importexcel(Request $request)
    {
        Excel::import(new MahasiswaImport, $request->file('file'));
        // Tambahkan toast setelah berhasil mengimpor file
        Session::flash('success', 'File Excel berhasil diimpor.');


        return redirect()->back();
    }
    public function filter(Request $request)
    {
        $semester = $request->input('semester');
        // Session::flash('success', 'Filter Berhasil.');
        $data = Mahasiswa::when($semester, function ($query) use ($semester) {
            $query->where('semester', $semester);
        })->paginate(10);

        $data->load('kegiatans');
        // dd($semester);


        return view('admin.mahasiswa.datamahasiswa', compact('data'));
    }
    public function hapusSemuaData(Request $request)
    {
        $semester = $request->input('semester');

        // Hapus data mahasiswa berdasarkan semester
        Mahasiswa::where('semester', $semester)->delete();
        // dd($semester);
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
    public function updateFiltered(Request $request)
    {
        $mahasiswaIds = $request->input('mahasiswa_id');
        $newSemesters = $request->input('new_semester');

        // Mengambil data mahasiswa yang terfilter berdasarkan ID
        $mahasiswaFiltered = Mahasiswa::whereIn('id', $mahasiswaIds)->get();

        // Melakukan pembaruan data pada setiap mahasiswa yang terfilter
        foreach ($mahasiswaFiltered as $index => $mahasiswa) {
            $mahasiswa->semester = $newSemesters[$index];
            $mahasiswa->save();

            $mahasiswa->status = 'aktive'; // Ubah status mahasiswa
            $mahasiswa->updateStatus(); // Hitung ulang jumlah kegiatan dan perbarui status
            $mahasiswa->save(); // Simpan perubahan ke dalam database
        }

        return redirect()->back()->with('success', 'Data mahasiswa terfilter berhasil diperbarui');
    }
    // public function updateFiltered(Request $request)
    // {
    //     $mahasiswaIds = $request->input('mahasiswa_id');
    //     $newSemesters = $request->input('new_semester');

    //     // Menggunakan array_combine untuk menggabungkan keys (mahasiswa_id) dengan values (new_semester)
    //     $dataToUpdate = array_combine($mahasiswaIds, $newSemesters);

    //     // Query untuk mengupdate data semester
    //     Mahasiswa::whereIn('id', $mahasiswaIds)->update([
    //         'semester' => DB::raw('CASE id ' . $this->buildCaseStatement($dataToUpdate) . ' END')
    //     ]);

    //     // Update status mahasiswa berdasarkan kegiatan verifikasi yang aktif
    //     foreach ($mahasiswaIds as $index => $mahasiswaId) {
    //         $mahasiswa = Mahasiswa::find($mahasiswaId);
    //         $mahasiswa->semester = $newSemesters[$index];

    //         // Memperbarui status mahasiswa berdasarkan kegiatan verifikasi yang aktif
    //         $mahasiswa->updateStatus();

    //         // Simpan perubahan ke dalam database, termasuk perubahan atribut "status"
    //         $mahasiswa->save();
    //     }

    //     return redirect()->back()->with('success', 'Data semester mahasiswa terfilter berhasil diperbarui');
    // }


    // private function buildCaseStatement(array $data)
    // {
    //     $caseStatement = '';
    //     foreach ($data as $mahasiswaId => $newSemester) {
    //         $caseStatement .= "WHEN {$mahasiswaId} THEN '{$newSemester}' ";
    //     }
    //     return $caseStatement;
    // }
}
