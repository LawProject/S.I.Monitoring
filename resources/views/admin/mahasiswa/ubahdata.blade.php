@extends('layout.admin')

@section('content')

    <body>
        <h1 class="text-center mb-4">Ubah Data Mahasiswa</h1>
        @if (session('warning'))
            <div class="position-fixed top-0 start-50 translate-middle-x">
                <div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-body">
                        {{ session('warning') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.updatemhs', [$data->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Mahasiswa</label>
                                    <input type="text" name="namamhs" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" value="{{ $data->namamhs }}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nim</label>
                                    <input type="text" name="nim" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" value="{{ $data->nim }}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Program Studi</label>
                                    <select class="form-select" name="programstudi" aria-label="Default select example">
                                        <option selected>{{ $data->programstudi }}</option>
                                        <option value="BudidayaTanamanPerkebunan">Budidaya Tanaman Perkebunan</option>
                                        <option value="TeknikInformatika">Teknik Informatika</option>
                                        <option value="TeknikOtomotif">Teknik Otomotif</option>
                                        <option value="BisnisDigital">Bisnis Digital</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nomor Induk Keluarga</label>
                                    <input type="text" name="nik" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" value="{{ $data->nik }}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Status Mahasiswa</label>
                                    <select class="form-select" name="status" aria-label="Default select example">
                                        <option selected>Pilih Status</option>
                                        <option value="aktive">aktive</option>
                                        <option value="tidak_aktive">tidak_aktive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
    </body>
@endsection
