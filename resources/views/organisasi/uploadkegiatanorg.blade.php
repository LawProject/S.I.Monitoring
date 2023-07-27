@extends('layout.organisasi')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DataTables</h1>
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

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Tambahkan Kegiatan</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('organisasi.tambahkegiatanorg') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="text">Nama Organisasi</label>
                                        <input type="text" class="form-control" name="nama_org"
                                            placeholder="Masukkan Nama Organisasi" value="{{ Auth::user()->name }}"
                                            readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="text">Nama Kegiatan</label>
                                        <input type="text" class="form-control" name="nama_kegiatan"
                                            placeholder="Masukkan Nama kegiatan" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="text">Tempat Kegiatan</label>
                                        <input type="text" class="form-control" name="tempat_kegiatan"
                                            placeholder="Tempat Kegiatan" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="text">Tanggal Kegiatan</label>
                                        <input type="date" class="form-control" name="tanggal_kegiatan"
                                            placeholder="Masukkan Nama" required>
                                    </div>
                                </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- right column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputFile">Foto Kegiatan</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="foto_kegiatan"
                                                placeholder="Masukkan Foto" id="exampleInputFile" required>
                                            <label class="custom-file-label" for="exampleInputFile"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="text">Pelaksana</label>
                                    <input type="text" class="form-control" name="pelaksana" placeholder="Masukkan Nama"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="text">Penanggung Jawab</label>
                                    <input type="text" class="form-control" name="penanggung_jawab"
                                        placeholder="Penanggung Jawab" required>
                                </div>
                                <div class="form-group">
                                    <label for="text">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi" placeholder="Masukkan Deskripsi" required></textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    </body>

    </html>
@endsection
