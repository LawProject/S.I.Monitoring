@extends('layout.organisasi')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Profile User</h3>
                            </div>
                            <form action="#" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            value="{{ $user->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            value="{{ $user->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        @if ($user->password)
                                            <input type="text" name="password" class="form-control" id="password"
                                                value="********">
                                        @else
                                            <input type="password" name="password" class="form-control" id="password"
                                                placeholder="Masukkan password baru">
                                        @endif
                                    </div>
                                    <!-- Tambahkan informasi profil lainnya sesuai kebutuhan -->
                                </div>
                                <div class="card-footer bg-gradient-dark">
                                    <button type="submit" class="btn btn-primary">Update Profil</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- <div class="col-md-6">

                        <div class="card">
                            <div class="card-header bg-gradient-olive">Grafik Kegiatan </div>
                            <div class="card-body bg-gradient-light">
                                <div id="Grafik">
                                    <canvas id="userActivityData" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div> --}}


                    <div class="col-md-6">
                        <!-- User Profile Picture -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Profile Organisasi</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Ketua Umum</label>
                                    <input type="text" name="nim" class="form-control" id="nim"
                                        value="{{ $user->organisasi->ketua }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Nomor Induk Organisasi</label>
                                    <input type="text" name="programstudi" class="form-control" id="programstudi"
                                        value="{{ $user->organisasi->nim }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Pembina</label>
                                    <input type="text" name="nik" class="form-control" id="nik"
                                        value="{{ $user->organisasi->pembina }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Periode</label>
                                    <input type="text" name="jenisbeasiswa" class="form-control" id="jenisbeasiswa"
                                        value="{{ $user->organisasi->periode }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Status</label>
                                    <input type="text" name="status" class="form-control" id="status"
                                        value="{{ $user->organisasi->status }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
