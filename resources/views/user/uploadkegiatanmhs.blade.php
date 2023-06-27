@extends('layout.user')

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
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Quick Example</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('user.tambahKegiatanMhs') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="text">Nama</label>
                                        <input type="text" class="form-control" name="nama"
                                            placeholder="Masukkan Nama">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelectRounded0">Jenis Kegiatan</label>
                                        <select class="custom-select rounded-0" name="jenis_kegiatan"
                                            id="exampleSelectRounded0">
                                            <option selected>Pilih Jenis Kegiatan</option>
                                            <option value="Akademik">Akademik</option>
                                            <option value="Organisasi">Organisasi</option>
                                            <option value="YHC">Yayasan Hasnur Centre</option>
                                            <option value="BaktiBanua">Pemuda Bakti Banua</option>
                                            <option value="PoliteknikHasnur">Politeknik Hasnur</option>
                                            <option value="ProgramStudi">ProgramStudi</option>
                                            <option value="DonaturBeasiswa">Donatur Beasiswa</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="text">Pelaksana</label>
                                        <input type="text" class="form-control" name="pelaksana" placeholder="pelaksana">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Foto Kegiatan</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="foto"
                                                    id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="text">Penanggung Jawab</label>
                                        <input type="text" class="form-control" name="penanggung_jawab"
                                            placeholder="Penanggung Jawab">
                                    </div>
                                </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        </form>
                    </div>
        </section> <!-- /.content -->
    </div> <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside> <!-- /.control-sidebar -->
    </div>
    </body>

    </html>
@endsection
