@extends('layout.admin')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                {{-- <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Daftar Pengguna</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">user</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row --> --}}
            </div><!-- /.container-fluid -->
        </div>
        <div class="container">
            <div class="row g-3 align-items-center mt-0">
                <div class="col-md-auto">
                    <form action="{{ route('admin.importUser') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                            <label for="file" class="form-label">Pilih file Excel:</label>
                            <input type="file" class="form-control" id="file" name="file" accept=".xls, .xlsx">
                        </div>
                        <div class="col-md-auto">
                            <button type="submit" class="btn btn-dark mb-1">Import</button>
                            <a href="{{ route('admin.user.create') }}" class="btn btn-dark mb-2">Tambah +</a>

                        </div>
                    </form>
                </div>

                {{-- <div class="col-md-auto">
                    <button type="button" class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Import Data
                    </button>
                </div> --}}
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.importUser') }}" method="post" enctype="multipart/form-data">
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
                            </form>
                        </div>
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
                                        <th scope="col" class="bg-gradient-dark text-white">Foto</th>
                                        <th scope="col" class="bg-gradient-dark text-white">Nama</th>
                                        <th scope="col" class="bg-gradient-dark text-white">Nim</th>
                                        <th scope="col" class="bg-gradient-dark text-white">Email</th>
                                        <th scope="col" class="bg-gradient-dark text-white">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($users as $index => $user)
                                        <tr>
                                            <th scope="row">{{ $index + $users->firstItem() }}</th>
                                            <td>
                                                <img src="{{ asset('foto/' . $user->foto) }}" alt=""
                                                    style="width: 40px">
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->nim }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                {{-- <a href="/tampildatamhs/{{ $user->id }}" class="badge bg-info">Ubah</a> --}}
                                                <form action="{{ route('admin.deleteuser', $user->id) }}" method="POST"
                                                    id="deleteForm">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="badge bg-danger delete"
                                                        data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                        onclick="deleteUser(event)">Hapus</button>

                                                </form>


                                                {{-- <a href="#" type="button" class="badge bg-danger delete"
                                            data-id="{{ $user->id }}" data-namamhs="{{ $user->name }}">Hapus</a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        function deleteUser(event) {
            event.preventDefault();
            var form = event.target.form;
            var id = form.querySelector('.delete').getAttribute('data-id');
            var name = form.querySelector('.delete').getAttribute('data-name');

            swal({
                title: "Yakin?",
                text: "Anda akan menghapus pengguna dengan nama " + name + "?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        }
        @if ($message = Session::get('success'))
            toastr.success("{{ $message }}");
        @endif
    </script>
@endpush
