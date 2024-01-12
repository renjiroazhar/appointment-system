@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profil Dokter</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ubah Profil Dokter</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <!-- Form -->
                    <form action="{{ route('profil.update', ['id' => $dokter->id]) }}" method="POST">
                        @csrf

                        <!-- Nama DOkter -->
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Dokter</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ $dokter->nama }}" required>
                        </div>

                        <!-- Tanggal Periksa -->
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Dokter</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                value="{{ $dokter->alamat }}" required>
                        </div>

                        <!-- Catatan -->
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No Telp</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp"
                                value="{{ $dokter->no_hp }}" required>
                        </div>

                        <!-- Tombol Simpan -->
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </form>
                    <!-- End Form -->
                </div>
                <!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
