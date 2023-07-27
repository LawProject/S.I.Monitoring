@extends('layout.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Post Seluruh Mahasiswa</h1>
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
                                            <th scope="col" class="bg-gradient-olive">No</th>
                                            <th scope="col" class="bg-gradient-olive">Nama</th>
                                            <th scope="col" class="bg-gradient-olive">Jenis Kegiatan</th>
                                            <th scope="col" class="bg-gradient-olive">Tanggal Kegiatan</th>
                                            <th scope="col" class="bg-gradient-olive">Pelaksana</th>
                                            <th scope="col" class="bg-gradient-olive">Foto Kegiatan</th>
                                            <th scope="col" class="bg-gradient-olive">Penanggung Jawab</th>
                                            <th scope="col" class="bg-gradient-olive">Status</th>
                                            <th scope="col" class="bg-gradient-olive">Aksi</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($data as $index => $row)
                                        <tbody>
                                            <tr>
                                                <td>{{ $index + $data->firstItem() }}</td>
                                                <td>{{ $row->user->name }}</td>
                                                <td>{{ $row->jenis_kegiatan }}</td>
                                                <td>{{ $row->tanggal_kegiatan }}</td>
                                                <td>{{ $row->pelaksana }}</td>
                                                <td>
                                                    <img src="{{ asset('fotokegiatan/' . $row->foto) }}" alt=""
                                                        style="width: 40px">
                                                </td>
                                                <td>{{ $row->penanggung_jawab }}</td>
                                                <td>
                                                    @if ($row->status == 1)
                                                        <span class="badge badge-success">Terverifikasi</span>
                                                    @else
                                                        <span class="badge badge-warning">Belum Verifikasi</span>
                                                        <a href="{{ route('admin.verifikasiKegiatan', ['id' => $row->id]) }}"
                                                            class="btn btn-primary">Verifikasi</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.kegiatan.detail', $row->id) }}"
                                                        class="btn btn-info">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.kegiatan.delete', $row->id) }}"
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
                                        </tbody>
                                    @endforeach
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

    <!-- SweetAlert -->
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
