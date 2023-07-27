@extends('layout.admin')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
@endpush
@section('content')
    <div class="content-wrapper">
        <div class="container">
            {{-- {{ Session::get('halaman_url') }} --}}
            <div class="row g-3 align-items-center mt-1">
                <div class="col-auto">
                    <form action="{{ route('admin.mahasiswa') }}" method="GET">
                        <input type="text" name="cari" placeholder="Cari Mahasiswa .." value="{{ old('cari') }}">
                        <input type="submit" value="CARI">
                    </form>
                </div>
                <div class="col-auto">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle mb-3" type="button" id="menuDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Menu
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="menuDropdown">
                            <li><a class="dropdown-item" href="{{ route('admin.tambahmhs') }}" class="btn btn-light">Tambah
                                    Mahasiswa</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('admin.eksportpdf') }}">Eksport PDF</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.eksportexcel') }}">Eksport Excel</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Import Excel</a></li>
                        </ul>
                    </div>
                </div>
                {{-- <div class="col-auto">
                    <a href="{{ route('admin.eksportexcel') }}" class="btn btn-dark mb-2">
                        <i class="fas fa-file-excel"></i> Eksport EXCEL
                    </a>
                </div>

                <div class="col-auto">
                    <button type="button" class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Import Data
                    </button>
                </div> --}}
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
                        <div class="card-header bg-info">
                        </div>
                        <div class="row align-items-end justify-content-center">
                            <div class="col-8">
                                <form action="{{ route('admin.hapussemuadata') }}" method="POST" id="form-hapus">
                                    @csrf
                                    @method('DELETE')
                                    <div class="row align-items-end">
                                        <div class="col-auto">
                                            <label for="semester" class="form-label">Pilih Semester:</label>
                                            <select name="semester" id="semester" class="form-control">
                                                <option value="">Semua</option>
                                                <option value="1">Semester 1</option>
                                                <option value="2">Semester 2</option>
                                                <option value="3">Semester 3</option>
                                                <option value="4">Semester 4</option>
                                                <option value="5">Semester 5</option>
                                                <option value="6">Semester 6</option>
                                                <!-- Tambahkan opsi semester lainnya sesuai kebutuhan -->
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-danger" onclick="confirmDelete()">Hapus
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-3">
                                <form action="{{ route('admin.filter') }}" method="GET" class="d-flex align-items-end">
                                    <div class="col-auto">
                                        <label for="semester" class="form-label">Pilih Semester:</label>
                                        <select name="semester" id="semester" class="form-control mb-0">
                                            <option value="">Semua</option>
                                            <option value="1">Semester 1</option>
                                            <option value="2">Semester 2</option>
                                            <option value="3">Semester 3</option>
                                            <option value="4">Semester 4</option>
                                            <option value="5">Semester 5</option>
                                            <option value="6">Semester 6</option>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary mb-0">Filter</button>
                                        <a href="#" class="btn btn-info" data-bs-toggle="modal"
                                            data-bs-target="#updateModal" data-id="#">Update</a>
                                    </div>
                                </form>

                                {{-- <a href="#" class="btn btn-info" data-bs-toggle="modal"
                                    data-bs-target="#updateModal" data-id="{{ $mahasiswa->id }}">Update</a> --}}


                                <!-- Modal -->
                                <!-- Modal -->
                                <div class="modal fade" id="updateModal" tabindex="-1"
                                    aria-labelledby="updateModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.updateFiltered') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="updateModalLabel">Update Semester
                                                        Mahasiswa</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Tampilkan data mahasiswa yang terfilter di dalam modal -->
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Nama Mahasiswa</th>
                                                                <th>Semester</th>
                                                                <th>Update</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($data as $mahasiswa)
                                                                <tr>
                                                                    <td>{{ $mahasiswa->namamhs }}</td>
                                                                    <td>{{ $mahasiswa->semester }}</td>
                                                                    <td>
                                                                        <input type="hidden" name="mahasiswa_id[]"
                                                                            value="{{ $mahasiswa->id }}">
                                                                        <select name="new_semester[]" class="form-select">
                                                                            <option value="">Pilih Semester</option>
                                                                            <option value="1">Semester 1</option>
                                                                            <option value="2">Semester 2</option>
                                                                            <option value="3">Semester 3</option>
                                                                            <option value="4">Semester 4</option>
                                                                            <option value="5">Semester 5</option>
                                                                            <option value="6">Semester 6</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <script>
                                    $('#updateModal').on('show.bs.modal', function(event) {
                                        var button = $(event.relatedTarget); // Tombol "Update" yang diklik
                                        var newSemester = button.data('semester'); // Ambil data semester dari tombol "Update"

                                        // Isi nilai semester baru ke input tersembunyi
                                        $(this).find('select[name="new_semester"]').val(newSemester);
                                    });
                                </script>

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            {{-- {{-- @if ($message = Session::get('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ $message }}
                                </div>
                            @endif --}}
                            <table class="table mt-0 ">
                                <thead>
                                    <tr>
                                        <th scope="col" class="bg-gradient-olive">No</th>
                                        <th scope="col" class="bg-gradient-olive">Nama Mahasiswa</th>
                                        <th scope="col" class="bg-gradient-olive">Nim</th>
                                        <th scope="col" class="bg-gradient-olive">program Studi</th>
                                        <th scope="col" class="bg-gradient-olive">Nik</th>
                                        <th scope="col" class="bg-gradient-olive">jalur Beasiswa</th>
                                        <th scope="col" class="bg-gradient-olive">Semester</th>
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
                                            <td>{{ $row->semester }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $row->status == 'aktive' ? 'bg-green' : 'bg-danger' }} text-light">{{ $row->status }}</span>
                                            </td>
                                            <td>
                                                {{-- <a href="{{ route('admin.tampildatamhs', [$row->id]) }}"
                                                    class="btn btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a> --}}
                                                <form action="{{ route('admin.deletemhs', $row->id) }}" method="POST"
                                                    id="deleteMhsForm-{{ $row->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger delete"
                                                        data-id="{{ $row->id }}" data-namamhs="{{ $row->namamhs }}"
                                                        onclick="deleteMahasiswa(event, {{ $row->id }})">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>

                                                {{-- <a href="{{ route('admin.deletemhs', [$row->id]) }}"
                                                    class="btn btn-danger delete" data-id="{{ $row->id }}"
                                                    data-namamhs="{{ $row->namamhs }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a> --}}

                                            </td>

                                        </tr>
                                        {{ $row->updateStatus() }}
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
<meta name="csrf-token" content="{{ csrf_token() }}">

@push('scripts')
    <script src="{{ asset('js/custom.js') }}"></script>

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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    </body>
    <script>
        function deleteMahasiswa(event, id) {
            event.preventDefault();
            var form = document.getElementById('deleteMhsForm-' + id);
            var namamhs = form.querySelector('.delete').getAttribute('data-namamhs');

            swal({
                title: 'Konfirmasi Hapus',
                text: `Apakah Anda yakin ingin menghapus mahasiswa '${namamhs}'?`,
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        }
    </script>
    <script>
        document.getElementById('hapusData').addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin menghapus data yang telah terfilter?')) {
                var semester = document.getElementById('semester').value;

                fetch('{{ route('admin.hapussemuadata') }}', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            semester: semester
                        })
                    })
                    .then(function(response) {
                        if (response.ok) {
                            alert('Data berhasil dihapus!');
                            location.reload();
                        } else {
                            alert('Terjadi kesalahan dalam menghapus data.');
                        }
                    })
                    .catch(function(error) {
                        alert('Terjadi kesalahan dalam menghapus data.');
                        console.log(error);
                    });
            }
        });
    </script>
    <script>
        function confirmDelete() {
            swal({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    // Aksi yang ingin dilakukan jika pengguna mengklik tombol "Ya, Hapus"
                    // Misalnya, submit form hapus
                    document.getElementById('form-hapus').submit();
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            @if (Session::has('success'))
                toastr.success("{{ Session::get('success') }}")
            @endif
        });
    </script>
@endpush
