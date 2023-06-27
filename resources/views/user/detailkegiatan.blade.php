@extends('layout.user')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Anda sedang melihat data dari {{ $data->nama }}</h1>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="card">
            <div class="card-header">
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>

                            <th scope="col">Nama</th>
                            <th scope="col">Foto Kegiatan</th>
                            <th scope="col">Jenis Kegiatan</th>
                            <th scope="col">Pelaksana</th>

                            <th scope="col">Penanggung Jawab</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>


                        <td>{{ $data->nama }}</td>
                        <td>
                            <img src="{{ asset('fotokegiatan/' . $data->foto) }}" alt="" style="width: 200px">
                        </td>
                        <td>{{ $data->jenis_kegiatan }}</td>
                        <td>{{ $data->pelaksana }}</td>

                        <td>{{ $data->penanggung_jawab }}</td>
                        <td>

                            <a href="" class="badge bg-danger"><span data-feather="eye">Edit</span></a>

                        </td>

                    </tbody>


                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
@endsection
