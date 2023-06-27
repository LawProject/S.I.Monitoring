@extends('layout.user')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <!-- ... bagian sebelumnya ... -->
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

                            <form action="{{ route('user.profile.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
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
                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="photo">Foto Profil</label>
                                            <input type="file" class="form-control-file" id="photo" name="foto">
                                        </div>
                                        <div class="form-group">
                                            <img id="preview" src="{{ asset('storage/' . Auth::user()->photo) }}"
                                                alt="Preview Foto" style="max-width: 200px;">
                                        </div>
                                    </div> --}}
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Update Profil</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#photo').change(function() {
            readURL(this);
        });
    </script>
@endsection
