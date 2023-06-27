<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Http\kegiatan;
use App\Models\Kegiatan;

class KegiatanMahasiswaController extends Controller
{
    public function index()
    {
        $data = Kegiatan::all();
        dd($data);
        return view('user.kegiatanmhs');
    }
}
