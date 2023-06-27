@extends('layout.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Welcome {{ auth()->user()->name }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Beasiswa Unggulan</span>
                                <span class="info-box-number">
                                    {{ $unggulan }}
                                    <span>Orang</span>

                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Berdikari</span>
                                <span class="info-box-number">{{ $berdikari }}
                                    <span>Orang</span>
                                </span>

                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Kip-Kuliah</span>
                                <span class="info-box-number">{{ $kipkuliah }}
                                    <span>Orang</span>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Beasiswa BSI</span>
                                <span class="info-box-number">{{ $bsi }}
                                    <span>Orang</span>
                                </span>

                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="card">
                            <div class="card-header bg-gradient-dark">Grafik Kegiatan </div>
                            <div class="card-body bg-gradient-light">
                                <div id="Grafik">
                                    <canvas id="activityChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="card">
                            <div class="card-header bg-gradient-dark">Grafik 10 Mahasiswa Teratas</div>
                            <div class="card-body bg-gradient-light">
                                <canvas id="mahasiswaChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="card">
                            <div class="card-header bg-gradient-dark">Grafik 3 Organisasi Teratas</div>
                            <div class="card-body bg-gradient-light">
                                <canvas id="organisasi-chart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                <script>
                    // Mendapatkan data kegiatan dari backend
                    var activityData = <?php echo json_encode($kegiatan); ?>;

                    // Mengubah data kegiatan menjadi format yang sesuai untuk Chart.js
                    var labels = [];
                    var counts = [];
                    var backgroundColors = [
                        'rgba(0, 123, 255, 0.5)',
                        'rgba(255, 0, 0, 0.5)',
                        'rgba(0, 255, 0, 0.5)',
                        'rgba(255, 255, 0, 0.5)',
                        'rgba(0, 255, 255, 0.5)',
                        'rgba(255, 0, 255, 0.5)',
                        'rgba(128, 128, 128, 0.5)'
                    ];

                    activityData.forEach(function(item, index) {
                        labels.push(item.jenis_kegiatan);
                        counts.push(item.count);
                    });

                    var chartData = {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Kegiatan',
                            data: counts,
                            backgroundColor: backgroundColors,
                            borderColor: 'rgba(0, 0, 0, 1)',
                            borderWidth: 1
                        }]
                    };


                    // Menggambar grafik menggunakan Chart.js
                    var ctx = document.getElementById('activityChart').getContext('2d');
                    var activityChart = new Chart(ctx, {
                        type: 'bar',
                        data: chartData,
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

                    // Mendapatkan data mahasiswa dari backend
                    var mahasiswaData = <?php echo json_encode($topMahasiswa); ?>;

                    // Mengubah data mahasiswa menjadi format yang sesuai untuk Chart.js
                    var labels = [];
                    var counts = [];

                    mahasiswaData.forEach(function(item) {
                        labels.push(item.nama_mahasiswa);
                        counts.push(item.count);
                    });

                    var chartData = {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Kegiatan',
                            data: counts,
                            backgroundColor: 'rgba(0, 255, 0, 0.5)',
                            borderColor: 'rgba(0, 0, 0, 1)',
                            borderWidth: 1
                        }]
                    };

                    // Menggambar grafik menggunakan Chart.js
                    var ctx = document.getElementById('mahasiswaChart').getContext('2d');
                    var mahasiswaChart = new Chart(ctx, {
                        type: 'bar',
                        data: chartData,
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
                    var labels = {!! json_encode($topOrganisasi->pluck('name')) !!};
                    var data = {!! json_encode($topOrganisasi->pluck('kegiatan_organisasi_count')) !!};

                    // Membuat grafik menggunakan Chart.js
                    var ctx = document.getElementById('organisasi-chart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Jumlah Kegiatan',
                                data: data,
                                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                borderColor: 'rgba(0, 0, 0, 1',
                                borderWidth: 1
                            }]
                        },
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


                <!-- /.row -->



                <!-- Main row -->

        </section>
        <!-- /.content -->

    </div>
@endsection
