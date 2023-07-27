@extends('layout.user')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <!-- ... Bagian kode lainnya ... -->
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
                                <h3 class="card-title">Masukkan Data Kegiatan</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('user.tambahKegiatanMhs') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="text">Nama</label>
                                                <input type="text" class="form-control" name="nama"
                                                    placeholder="Masukkan Nama" value="{{ Auth::user()->name }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleSelectRounded0">Jenis Kegiatan</label>
                                                <select class="custom-select rounded-0" name="jenis_kegiatan"
                                                    id="exampleSelectRounded0" required>
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
                                                <label for="tanggal_kegiatan">Tanggal Kegiatan</label>
                                                <input type="date" name="tanggal_kegiatan" id="tanggal_kegiatan"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="text">Pelaksana</label>
                                                <input type="text" class="form-control" name="pelaksana"
                                                    placeholder="pelaksana" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputFile">Foto Kegiatan</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="foto"
                                                            id="exampleInputFile" required>
                                                        <label class="custom-file-label" for="exampleInputFile">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="text">Penanggung Jawab</label>
                                                <input type="text" class="form-control" name="penanggung_jawab"
                                                    placeholder="Penanggung Jawab" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="deskripsi">Deskripsi Kegiatan</label>
                                                <textarea class="form-control" name="deskripsi_kegiatan" rows="4" placeholder="Masukkan Deskripsi Kegiatan"
                                                    required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                <!-- ... Bagian kode lainnya ... -->
                            </form>
                        </div>
                        <!-- /.card-body -->

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
