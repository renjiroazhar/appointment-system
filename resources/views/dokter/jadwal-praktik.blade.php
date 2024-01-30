@extends('layouts.main')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Jadwal Praktik</h1>

            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Jadwal Praktik</h3>
                <button class="btn btn-primary float-right" data-toggle="modal" data-target="#tambahModal">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @elseif (session('failed'))
                <div class="alert alert-danger">
                    {{ session('failed') }}
                </div>
                @endif
                @if ($jadwal)
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Hari</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwal as $jadwal_periksa)
                        <tr>
                            <td>{{ $jadwal_periksa->hari }}</td>
                            <td>{{ date('H:i', strtotime($jadwal_periksa->jam_mulai)) }}</td>
                            <td>{{ date('H:i', strtotime($jadwal_periksa->jam_selesai)) }}</td>
                            <td>{{ $jadwal_periksa->aktif == 'Y' ? 'Aktif' : 'Tidak Aktif' }}</td>
                            <td>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#editModal{{ $jadwal_periksa->id }}">
                                    <i class="fas fa-edit"></i> Ubah
                                </button>
                                <!-- <button class="btn btn-danger" data-toggle="modal"
                                                    data-target="#hapusModal{{ $jadwal_periksa->id }}">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button> -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p class="text-center">Anda belum memiliki jadwal praktik <br> Atur jadwal praktik di form pada sisi kiri</p>
                @endif
                <!-- Modal Tambah -->
                <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahModalLabel">Tambah Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('jadwalpraktik.store') }}" method="POST">
                                    @csrf
                                    <input required type="hidden" id="id_dokter" name="id_dokter" value="{{ $dokter->id }}">
                                    <div class="form-group">
                                        <label for="hari">Hari</label>
                                        <select class="form-control" id="hari" name="hari" required>
                                            <option value="Senin">Senin</option>
                                            <option value="Selasa">Selasa</option>
                                            <option value="Rabu">Rabu</option>
                                            <option value="Kamis">Kamis</option>
                                            <option value="Jumat">Jumat</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="jam_mulai">Jam Mulai</label>
                                        <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="jam_selesai">Jam Selesai</label>
                                        <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" required>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal Ubah -->
                @foreach ($jadwal as $jadwal_periksa)
                <div class="modal fade" id="editModal{{ $jadwal_periksa->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Ubah Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editForm" action="{{ route('jadwalpraktik.update', ['id' => $jadwal_periksa->id]) }}" method="POST">
                                    @csrf
                                    <input required type="hidden" id="id_dokter" name="id_dokter" value="{{ $dokter->id }}">
                                    <div class="form-group">
                                        <label for="hari">Hari</label>
                                        <input readonly type="text" class="form-control" id="hari" name="hari" value="{{ $jadwal_periksa->hari }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="jam_mulai">Jam Mulai</label>
                                        <input readonly type="time" class="form-control" id="jam_mulai" name="jam_mulai" value="{{ date('H:i', strtotime($jadwal_periksa->jam_mulai)) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="jam_selesai">Jam Selesai</label>
                                        <input readonly type="time" class="form-control" id="jam_selesai" name="jam_selesai" value="{{ date('H:i', strtotime($jadwal_periksa->jam_selesai)) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="aktif">Status</label>
                                        <select class="form-control" id="aktif" name="aktif" required>
                                            <option value="Y" {{ $jadwal_periksa->aktif == 'Y' ? 'selected' : '' }}>Aktif</option>
                                            <option value="T" {{ $jadwal_periksa->aktif == 'T' ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan
                                    Perubahan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Hapus -->
                <!-- <div class="modal fade" id="hapusModal{{ $jadwal_periksa->id }}" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah Anda yakin akan menghapus data ini?</p>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('jadwalpraktik.destroy', ['id' => $jadwal_periksa->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> -->
                @endforeach
            </div>
            <!-- /.card-body -->
        </div>
    </div><!-- /.container-fluid -->
</div>
@endsection