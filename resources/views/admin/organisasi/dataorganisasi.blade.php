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
                        <h1 class="m-0">Data Organisasi</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Organisasi</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="container">
            <a href="{{ route('admin.tambahorganisasi') }}" class="btn btn-light">Tambah +</a>

            <div class="row g-3 align-items-center mt-0">

                <div class="col-auto">
                    <a href="{{ route('admin.eksportpdforg') }}" class="btn btn-dark mb-2">Eksport PDF</a>
                </div>
                <div class="col-auto">
                    <a href="/eksportexcel" class="btn btn-dark mb-2">Eksport EXCEL</a>
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
                            <form action="#" method="post" enctype="multipart/form-data">
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
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            {{ $message }}
                        </div>
                    @endif

                    <table class="table  table-dark table-striped">
                        <thead>
                            <tr>
                                <th scope="col" class="bg-gradient-navy">No</th>
                                <th scope="col" class="bg-gradient-navy">Nama Organisasi</th>
                                <th scope="col" class="bg-gradient-navy">Ketua Umum</th>
                                <th scope="col" class="bg-gradient-navy">Periode</th>
                                <th scope="col" class="bg-gradient-navy">Pembina</th>
                                <th scope="col" class="bg-gradient-navy">Status</th>
                                <th scope="col" class="bg-gradient-navy">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $row)
                                <tr>
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>{{ $row->namaorganisasi }}</td>
                                    <td>{{ $row->ketua }}</td>
                                    <td>{{ $row->periode }}</td>
                                    <td>{{ $row->pembina }}</td>
                                    <td>
                                        @if ($row->status == 'aktif')
                                            <span class="badge bg-success text-light">{{ $row->status }}</span>
                                        @elseif ($row->status == 'tidak_aktif')
                                            <span class="badge bg-danger text-light">{{ $row->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.tampildataorg', [$row->id]) }}}}"
                                            class="badge bg-info">Ubah</a>
                                        <a href="{{ route('admin.deleteorg', [$row->id]) }}" type="button"
                                            class="badge bg-danger delete" data-id="{{ $row->id }}"
                                            data-namaorganisasi="{{ $row->namaorganisasi }}">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    </body>

    <script>
        $('.delete').click(function() {
            var organisasiid = $(this).attr('data-id');
            var namaorganisasi = $(this).attr('data-namaorganisasi');
            swal({
                    title: "Yakin?",
                    text: "Kamu akan menghapus data Organisasi  " + namaorganisasi + "",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/deleteorg/" + organisasiid + "";
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
        @if (session::has('success'))
            toastr.success("{{ Session::get('success') }}")
        @endif
    </script>
@endpush
