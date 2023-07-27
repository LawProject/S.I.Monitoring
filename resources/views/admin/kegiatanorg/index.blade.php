@extends('layout.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Post Seluruh Kegiatan organisasi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Kegiatan Mahasiswa</li>
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
                                        @foreach ($data as $kegiatan)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $kegiatan->user->name }}</td>
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
                                                    @if ($kegiatan->status_verifikasi)
                                                        <span class="badge badge-success">Terverifikasi</span>
                                                    @else
                                                        <span class="badge badge-warning">Belum Terverifikasi</span>
                                                        <a href="{{ route('admin.verify', ['id' => $kegiatan->id]) }}"
                                                            class="btn btn-primary">Verifikasi</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.detailKegiatanOrg', [$kegiatan->id]) }}"
                                                        class="btn btn-info">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.deleteKegiatanOrg', $kegiatan->id) }}"
                                                        method="POST" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger delete-btn"
                                                            style="border: none; cursor: pointer;">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                {{ $data->links() }}
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

    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Menangkap semua form penghapusan
            const deleteForms = document.querySelectorAll('.delete-form');

            // Iterasi melalui setiap form penghapusan
            deleteForms.forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // Menampilkan SweetAlert konfirmasi hapus
                    Swal.fire({
                        title: 'Konfirmasi',
                        text: 'Apakah Anda yakin ingin menghapus kegiatan ini?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        // Jika tombol Hapus diklik
                        if (result.isConfirmed) {
                            // Mengirimkan form penghapusan
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
