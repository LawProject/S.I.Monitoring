@extends('layout.user')

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
                                <a href="{{ route('user.upload') }}" class="btn btn-success"><span
                                        data-feather="upload"></span> Upload</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="bg-gradient-navy">No</th>
                                            <th scope="col" class="bg-gradient-navy">Nama</th>
                                            <th scope="col" class="bg-gradient-navy">Jenis Kegiatan</th>
                                            <th scope="col" class="bg-gradient-navy">Pelaksana</th>
                                            <th scope="col" class="bg-gradient-navy">Foto Kegiatan</th>
                                            <th scope="col" class="bg-gradient-navy">Penanggung Jawab</th>
                                            <th scope="col" class="bg-gradient-navy">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($data as $row)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $row->nama }}</td>
                                                <td>{{ $row->jenis_kegiatan }}</td>
                                                <td>{{ $row->pelaksana }}</td>
                                                <td>
                                                    <img src="{{ asset('fotokegiatan/' . $row->foto) }}" alt=""
                                                        style="width: 40px">
                                                </td>
                                                <td>{{ $row->penanggung_jawab }}</td>
                                                <td>
                                                    <a href="detail/{{ $row->id }}" class="badge bg-info"><span
                                                            data-feather="eye"></span> Detail</a>
                                                    <a href="#" class="badge bg-warning"><span
                                                            data-feather="edit"></span> Edit</a>
                                                    <a href="#" class="badge bg-danger"><span
                                                            data-feather="trash"></span> Hapus</a>
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
