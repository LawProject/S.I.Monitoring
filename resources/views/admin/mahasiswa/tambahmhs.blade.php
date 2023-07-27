@extends('layout.admin')

@section('content')

    <body>
        <h1 class="text-center mb-4">Tambah Data Mahasiswa</h1>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.tambah') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Mahasiswa</label>
                                    <input type="text" name="namamhs" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                    @error('namamhs')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nim</label>
                                    <input type="text" name="nim" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                    @error('nim')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Program Studi</label>
                                    <select class="form-select" name="programstudi" aria-label="Default select example">
                                        <option selected>Pilih Program Studi</option>
                                        <option value="BudidayaTanamanPerkebunan">Budidaya Tanaman Perkebunan</option>
                                        <option value="TeknikInformatika">Teknik Informatika</option>
                                        <option value="TeknikOtomotif">Teknik Otomotif</option>
                                        <option value="BisnisDigital">Bisnis Digital</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nomor Induk Keluarga</label>
                                    <input type="text" name="nik" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Jenis Beasiswa</label>
                                    <select class="form-select" name="jenisbeasiswa" aria-label="Default select example">
                                        <option selected>Pilih Jenis Beasiswa</option>
                                        <option value="Unggulan">Unggulan</option>
                                        <option value="Berdikari">Berdikari</option>
                                        <option value="KIpKuliah">Kip Kuliah</option>
                                        <option value="BSI">BSI</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Status Mahasiswa</label>
                                    <select class="form-select" name="status" aria-label="Default select example">
                                        <option selected>Pilih Status</option>
                                        <option value="aktive">aktive</option>
                                        <option value="tidak_aktive">tidak_aktive</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Semester</label>
                                    <select class="form-select" name="semester" aria-label="Default select example">
                                        <option selected>1</option>
                                        <option value="1">1</option>
                                        <option value="2">3</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tautkan library Toastr.js dan CSS-nya -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script>
            @if (Session::has('message'))
                var type = "{{ Session::get('alert-type', 'info') }}";
                switch (type) {
                    case 'info':
                        toastr.info("{{ Session::get('message') }}");
                        break;
                    case 'success':
                        toastr.success("{{ Session::get('message') }}");
                        break;
                    case 'warning':
                        toastr.warning("{{ Session::get('message') }}");
                        break;
                    case 'error':
                        toastr.error("{{ Session::get('message') }}");
                        break;
                }
            @endif
        </script>
    </body>
@endsection
