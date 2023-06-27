@php
    $kegiatan = $logKeg;
@endphp

@extends('layout.user')

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
                <!-- /.row -->
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-gradient-danger elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Keg.Organisasi</span>
                                <span class="info-box-number">
                                    {{ $organisasi }}
                                    <span>kegiatan</span>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-gradient-warning elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Keg.Akademik</span>
                                <span class="info-box-number">
                                    {{ $akademik }}
                                    <span>kegiatan</span>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-gradient-success elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Keg.YHC</span>
                                <span class="info-box-number">
                                    {{ $YHC }}
                                    <span>kegiatan</span>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-gradient-light elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Keg.Politeknik Hasnur</span>
                                <span class="info-box-number">
                                    {{ $polhas }}
                                    <span>kegiatan</span>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Keg.Program Studi</span>
                                <span class="info-box-number">
                                    {{ $prodi }}
                                    <span>kegiatan</span>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-gradient-olive elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Keg.Donatur Beasiswa</span>
                                <span class="info-box-number">
                                    {{ $mudabanua }}
                                    <span>kegiatan</span>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Keg.BaktiBanua</span>
                                <span class="info-box-number">
                                    {{ $donatur }}
                                    <span>kegiatan</span>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                </div>
                <h2 style="background: #1f1d1d;; padding: 10px; display: inline-block; border-radius: 10px;"><b>Log
                        Post</b></h2>
                <div class="mt-2">
                    <table class="table" style="border-radius: 50px;">
                        <thead>
                            <tr>
                                <th class="bg-gradient-navy">NO.</th>
                                <th class="bg-gradient-navy">Foto</th>
                                <th class="bg-gradient-navy">Jenis Kegiatan</th>
                                <th class="bg-gradient-navy">Pelaksana</th>
                                <th class="bg-gradient-navy">Penanggung Jawab</th>
                                <th class="bg-gradient-navy">Di Upload</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kegiatan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('fotokegiatan/' . $item->foto) }}" alt=""
                                            style="width: 40px">
                                    </td>
                                    <td>{{ $item->jenis_kegiatan }}</td>
                                    <td>{{ $item->pelaksana }}</td>
                                    <td>{{ $item->penanggung_jawab }}</td>
                                    <td>{{ $item->created_at }}</td>
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
            @elseif (Auth::user()->hasRole('user'))
                <!-- User Dashboard Content -->
                <h3>Ini adalah konten khusus untuk user</h3>
            @endif
        </section>
        <!-- /.content -->
    </div>
@endsection
