@extends('layout.user')

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
                            <form action="{{ route('user.profile.update', $user->id) }}" method="POST"
                                enctype="multipart/form-data">
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
                                                value="">
                                        @else
                                            <input type="password" name="password" class="form-control" id="password"
                                                placeholder="Masukkan password baru">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="foto">Foto</label>
                                        <input type="file" name="foto" class="form-control-file" id="foto"
                                            value="{{ $user->foto }}">
                                    </div>
                                    <!-- Tambahkan informasi profil lainnya sesuai kebutuhan -->
                                </div>
                                <div class="card-footer bg-gradient-dark">
                                    <button type="submit" class="btn btn-primary">Update Profil</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- User Profile Picture -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Profile Picture</h3>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    @if ($user->foto)
                                        <img src="{{ asset('foto/' . $user->foto) }}" alt="Profile Picture"
                                            class="img-fluid" style="max-height: 200px;">
                                    @else
                                        <span class="text-muted">No Profile Picture</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- User Profile Picture -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Profile Picture</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nim</label>
                                    <input type="text" name="nim" class="form-control" id="nim"
                                        value="{{ $user->mahasiswa->nim }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Program Studi</label>
                                    <input type="text" name="programstudi" class="form-control" id="programstudi"
                                        value="{{ $user->mahasiswa->programstudi }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">NIK</label>
                                    <input type="text" name="nik" class="form-control" id="nik"
                                        value="{{ $user->mahasiswa->nik }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Jenis Beasiswa</label>
                                    <input type="text" name="jenisbeasiswa" class="form-control" id="jenisbeasiswa"
                                        value="{{ $user->mahasiswa->jenisbeasiswa }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Status</label>
                                    <input type="text" name="status" class="form-control" id="status"
                                        value="{{ $user->mahasiswa->status }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var activities = {!! json_encode($grafikuser) !!};
        console.log(activities);
        var ctx = document.getElementById('userActivityData').getContext('2d');
        var data = {
            labels: activities.map(activity => activity.jenis),
            datasets: [{
                label: 'Jumlah Kegiatan',
                data: activities.map(activity => activity.count),
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }
            }
        });
    </script>
@endsection
