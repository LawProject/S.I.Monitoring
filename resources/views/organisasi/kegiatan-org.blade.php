@extends('layout.organisasi')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Kegiatan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Kegiatan</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('organisasi.upload') }}" class="btn btn-success"><span
                                        data-feather="upload"></span> Upload</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="bg-gradient-navy">No</th>
                                            <th scope="col" class="bg-gradient-navy">Nama organisasi</th>
                                            <th scope="col" class="bg-gradient-navy">Nama Kegiatan</th>
                                            <th scope="col" class="bg-gradient-navy">Tempat Kegitan</th>
                                            <th scope="col" class="bg-gradient-navy">Tanggal Kegiatan</th>
                                            <th scope="col" class="bg-gradient-navy">Foto Kegiatan</th>
                                            <th scope="col" class="bg-gradient-navy">Pelaksana</th>
                                            <th scope="col" class="bg-gradient-navy">Penanggung Jawab</th>
                                            <th scope="col" class="bg-gradient-navy">Status</th>
                                            <th scope="col" class="bg-gradient-navy">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($kegiatanOrganisasi as $kegiatan)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ Auth::user()->name }}</td>
                                                <td>{{ $kegiatan->nama_kegiatan }}</td>
                                                <td>{{ $kegiatan->tempat_kegiatan }}</td>
                                                <td>{{ $kegiatan->tanggal_kegiatan }}</td>
                                                <td>
                                                    <img src="{{ asset('fotokegiatan-org/' . $kegiatan->foto_kegiatan) }}"
                                                        alt="" style="width: 40px">
                                                </td>
                                                <td>{{ $kegiatan->pelaksana }}</td>
                                                <td>{{ $kegiatan->penanggung_jawab }}</td>
                                                <td>
                                                    @if ($kegiatan->status_verifikasi == 1)
                                                        <span class="badge badge-success">Terverifikasi</span>
                                                    @else
                                                        <span class="badge badge-warning">Belum Verifikasi</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('organisasi.detailuserOrg', [$kegiatan->id]) }}"
                                                        class="badge bg-info"><span data-feather="eye"></span>
                                                        Detail</a>
                                                    {{-- <a href="#" class="badge bg-warning"><span
                                                            data-feather="edit"></span>
                                                        Edit</a>
                                                    <a href="#" class="badge bg-danger"><span
                                                            data-feather="trash"></span>
                                                        Hapus</a> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
