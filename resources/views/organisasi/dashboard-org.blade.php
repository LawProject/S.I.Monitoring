@php
    $kegiatanOrganisasi = $logKeg;
@endphp
@extends('layout.organisasi')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 mt-2 mb-3">Halo Selamat Datang {{ auth()->user()->name }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard </li>
                        </ol>
                    </div><!-- /.col -->
                </div>
                <div class="mt-2">
                    <table class="table" style="border-radius: 50px;">
                        <thead>
                            <tr>
                                <th class="bg-gradient-navy">NO.</th>
                                <th class="bg-gradient-navy">Nama Kegiatan</th>
                                <th class="bg-gradient-navy">Tempat Kegiatan</th>
                                <th class="bg-gradient-navy">Tanggal Kegiatan</th>
                                <th class="bg-gradient-navy">Pelaksana</th>
                                <th class="bg-gradient-navy">Di Upload</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($kegiatanOrganisasi as $kegiatan)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $kegiatan->nama_kegiatan }}</td>
                                    <td>{{ $kegiatan->tempat_kegiatan }}</td>
                                    <td>{{ $kegiatan->tanggal_kegiatan }}</td>
                                    <td>{{ $kegiatan->pelaksana }}</td>
                                    <td>{{ $kegiatan->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <!-- Check the user role and display the appropriate content -->
            @if (Auth::user()->hasRole('admin'))
                <!-- Admin Dashboard Content -->
                <h3>Ini adalah konten khusus untuk admin</h3>
            @elseif (Auth::user()->hasRole('organisasi'))
                <!-- User Dashboard Content -->
                <h3>Ini adalah konten khusus untuk Organisasi</h3>
            @endif
        </section>
        <!-- /.content -->
    </div>
@endsection
