@extends('layout.admin')
@section('content')

    <body>
        <br>
        <br>
        <h1 class="text-center mb-4 mt-5"> Ubah Data Organisasi</h1>

        <div class="container mb-5">
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.updateorg', [$data->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Organisasi</label>
                                    <input type="text" name="namaorganisasi" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" value="{{ $data->namaorganisasi }}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Ketua Umum</label>
                                    <input type="text" name="ketua" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" value="{{ $data->ketua }}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Pembina</label>
                                    <input type="text" name="pembina" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" value="{{ $data->pembina }}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Periode</label>
                                    <input type="text" name="periode" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" value="{{ $data->periode }}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Status Mahasiswa</label>
                                    <select class="form-select" name="status" aria-label="Default select example">
                                        <option selected>Pilih Status</option>
                                        <option value="aktif">aktif</option>
                                        <option value="tidak_aktif">tidak_aktif</option>
                                    </select>
                                </div>
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
