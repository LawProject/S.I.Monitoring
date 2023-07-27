@extends('layout.admin')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css">
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            {{-- <div class="container-fluid">
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
            </div><!-- /.container-fluid --> --}}
        </div>
        <div class="container">
            <div class="row g-3 align-items-center mt-0">
                <div class="col-auto">
                    <a href="{{ route('admin.eksportpdforg') }}" class="btn btn-dark mb-2">Eksport PDF</a>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.tambahorganisasi') }}" class="btn btn-light mb-2">Tambah +</a>
                </div>
                {{-- <div class="col-auto">
                    <a href="#" class="btn btn-dark mb-2">Eksport EXCEL</a>
                </div> --}}

                {{-- <div class="col-auto">
                    <button type="button" class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Import Data
                    </button> --}}
            </div>
            <!-- Button trigger modal -->
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                <div class="card">
                    <div class="card-header bg-secondary">
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="bg-gradient-dark text-white">No</th>
                                    <th scope="col" class="bg-gradient-dark text-white">Nama Organisasi</th>
                                    <th scope="col" class="bg-gradient-dark text-white">Nomo Induk Organisasi</th>
                                    <th scope="col" class="bg-gradient-dark text-white">Ketua Umum</th>
                                    <th scope="col" class="bg-gradient-dark text-white">Periode</th>
                                    <th scope="col" class="bg-gradient-dark text-white">Pembina</th>
                                    <th scope="col" class="bg-gradient-dark text-white">Status</th>
                                    <th scope="col" class="bg-gradient-dark text-white">Aksi</th>
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
                                        <td>{{ $row->nim }}</td>
                                        <td>{{ $row->ketua }}</td>
                                        <td>{{ $row->periode }}</td>
                                        <td>{{ $row->pembina }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $row->status == 'aktif' ? 'bg-green' : 'bg-danger' }} text-light">{{ $row->status }}</span>

                                        </td>
                                        <td>
                                            <a href="{{ route('admin.tampildataorg', [$row->id]) }}" class="btn btn-info">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.deleteorg', [$row->id]) }}" method="POST"
                                                id="deleteOrgForm-{{ $row->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger delete"
                                                    data-id="{{ $row->id }}"
                                                    data-namaorganisasi="{{ $row->namaorganisasi }}"
                                                    onclick="deleteOrganisasi(event, {{ $row->id }})">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>


                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
    <script>
        function deleteOrganisasi(event, id) {
            event.preventDefault();
            var form = document.getElementById('deleteOrgForm-' + id);
            var namaorganisasi = form.querySelector('.delete').getAttribute('data-namaorganisasi');

            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: `Apakah Anda yakin ingin menghapus organisasi '${namaorganisasi}'?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
        @if ($message = Session::get('success'))
            toastr.success("{{ $message }}");
        @endif
    </script>
@endpush
