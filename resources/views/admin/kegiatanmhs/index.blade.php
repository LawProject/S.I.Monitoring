@extends('layout.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Post Seluruh Mahasiswa</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Kegiatan Mahasiswa</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="bg-gradient-olive">No</th>
                                            <th scope="col" class="bg-gradient-olive">Nama</th>
                                            <th scope="col" class="bg-gradient-olive">Jenis Kegiatan</th>
                                            <th scope="col" class="bg-gradient-olive">Pelaksana</th>
                                            <th scope="col" class="bg-gradient-olive">Foto Kegiatan</th>
                                            <th scope="col" class="bg-gradient-olive">Penanggung Jawab</th>
                                            <th scope="col" class="bg-gradient-olive">Aksi</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($data as $index => $row)
                                        <tbody>
                                            <tr>
                                                <td>{{ $index + $data->firstItem() }}</td>

                                                <td>{{ $row->nama }}</td>
                                                <td>{{ $row->jenis_kegiatan }}</td>
                                                <td>{{ $row->pelaksana }}</td>
                                                <td>
                                                    <img src="{{ asset('fotokegiatan/' . $row->foto) }}" alt=""
                                                        style="width: 40px">
                                                </td>
                                                <td>{{ $row->penanggung_jawab }}</td>
                                                <td>
                                                    <a href="detail/{{ $row->id }}" class="badge bg-info"><span
                                                            data-feather="eye">Detail</span></a>
                                                    <a href="" class="badge bg-danger"><span
                                                            data-feather="eye">Hapus</span></a>

                                                </td>
                                            </tr>
                                        </tbody>
                                    @endforeach

                                </table>
                                <br>
                                {{ $data->links() }}
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->

    </body>

    </html>
@endsection
