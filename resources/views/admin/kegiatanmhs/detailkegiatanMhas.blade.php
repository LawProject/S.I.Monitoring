@extends('layout.admin')

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
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <a href="{{ asset('fotokegiatan/' . $data->foto) }}" target="_blank">
                                <img src="{{ asset('fotokegiatan/' . $data->foto) }}" alt=""
                                    style="width: 200px; cursor: pointer;" class="img-thumbnail" data-toggle="modal"
                                    data-target="#modalFotoKegiatan">
                            </a>
                        </div>
                        <div class="mt-4">
                            <h2 class="text-center">{{ $data->nama }}</h2>
                            <p class="text-center mb-3">Tanggal Kegiatan: {{ $data->tanggal_kegiatan }}</p>
                            <div class="d-flex justify-content-center">
                                <div class="mr-4">
                                    <p><strong>Jenis Kegiatan:</strong> {{ $data->jenis_kegiatan }}</p>
                                </div>
                                <div class="ml-4">
                                    <p><strong>Pelaksana:</strong> {{ $data->pelaksana }}</p>
                                </div>
                            </div>
                            <div class="text-center">
                                <p><strong>Penanggung Jawab:</strong> {{ $data->penanggung_jawab }}</p>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <h3 class="mb-3">Deskripsi Kegiatan</h3>
                            <p>{{ $data->deskripsi_kegiatan }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalFotoKegiatan" tabindex="-1" role="dialog" aria-labelledby="modalFotoKegiatanLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFotoKegiatanLabel">Foto Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('fotokegiatan/' . $data->foto) }}" alt="" style="width: 100%;"
                        class="img-fluid">
                </div>
            </div>
        </div>
    </div>
@endsection
