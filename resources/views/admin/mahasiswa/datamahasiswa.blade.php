@extends('layout.admin')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Mahasiswa</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Mahasiswa</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="container">
            <a href="{{ route('admin.tambahmhs') }}" class="btn btn-light">Tambah +</a>
            {{-- {{ Session::get('halaman_url') }} --}}
            <div class="row g-3 align-items-center mt-0">
                <div class="col-auto">
                    <form action="{{ route('admin.mahasiswa') }}" method="GET">
                        <input type="text" name="cari" placeholder="Cari Mahasiswa .." value="{{ old('cari') }}">
                        <input type="submit" value="CARI">
                    </form>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.eksportpdf') }}" class="btn btn-dark mb-2">Eksport PDF</a>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.eksportexcel') }}" class="btn btn-dark mb-2">Eksport EXCEL</a>
                </div>

                <div class="col-auto">
                    <button type="button" class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Import Data
                    </button>
                </div>
                <!-- Button trigger modal -->
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.importexcel') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="modal-body">
                                    <div class="from-group">
                                        <input type="file" name="file" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-6 col-md-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ $message }}
                                </div>
                            @endif
                            <table class="table  table-dark table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" class="bg-gradient-olive">No</th>
                                        <th scope="col" class="bg-gradient-olive">Nama Mahasiswa</th>
                                        <th scope="col" class="bg-gradient-olive">Nim</th>
                                        <th scope="col" class="bg-gradient-olive">program Studi</th>
                                        <th scope="col" class="bg-gradient-olive">Nik</th>
                                        <th scope="col" class="bg-gradient-olive">jalur Beasiswa</th>
                                        <th scope="col" class="bg-gradient-olive">Status</th>
                                        <th scope="col" class="bg-gradient-olive">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($data as $index => $row)
                                        <tr>
                                            <th scope="row">{{ $index + $data->firstItem() }}</th>
                                            <td>{{ $row->namamhs }}</td>
                                            <td>{{ $row->nim }}</td>
                                            <td>{{ $row->programstudi }}</td>
                                            <td>{{ $row->nik }}</td>
                                            <td>{{ $row->jenisbeasiswa }}</td>
                                            <td>
                                                {{-- @php
                                                    $jumlahKegiatan = $row->kegiatans->count();
                                                    $status = $jumlahKegiatan >= 2 ? 'aktive' : 'tidak_aktive';
                                                @endphp --}}
                                                <span
                                                    class="badge {{ $row->status == 'aktive' ? 'bg-primary' : 'bg-danger' }} text-light">{{ $row->status }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.tampildatamhs', [$row->id]) }}"
                                                    class="badge bg-warning">Ubah</a>
                                                <a href="{{ route('admin.deletemhs', [$row->id]) }}" type="button"
                                                    class="badge bg-danger delete" data-id="{{ $row->id }}"
                                                    data-namamhs="{{ $row->namamhs }}">Hapus</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js"
        integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.slim.js"
        integrity="sha256-7GO+jepT9gJe9LB4XFf8snVOjX3iYNb0FHYr5LI1N5c=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    </body>

    <script>
        $('.delete').click(function() {
            var mahasiswaid = $(this).attr('data-id');
            var namamhs = $(this).attr('data-namamhs');
            swal({
                    title: "Yakin?",
                    text: "Kamu akan menghapus data mahasiswa dengan Nama " + namamhs + "",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/deletemhs/" + mahasiswaid + "";
                        swal("Data Berhasil di Hapus!", {
                            icon: "success",
                        });
                    } else {
                        swal("Data tidak jadi dihapus");
                    }
                });
        });
    </script>

    <script>
        $(document).ready(function() {
            @if (Session::has('success'))
                toastr.success("{{ Session::get('success') }}")
            @endif
        });
    </script>
@endpush
