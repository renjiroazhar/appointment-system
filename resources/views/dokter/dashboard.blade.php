@extends('layouts.main')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="container-fluid">
            <br>
            <h2>Dashboard Dokter</h2>
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $jadwal }}</h3>
                            <p>Jadwal Praktik</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clock"></i>
                        </div>
                        <a href="{{ route('jadwalpraktik') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6 col-md-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>Periksa Pasien</h3>
                            <p>Pilih pasien untuk diperiksa</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clipboard"></i>
                        </div>
                        <a href="{{ route('periksapasien') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6 col-md-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>Riwayat Periksa</h3>
                            <p>Melihat riwayat periksa dari pasien</p>
                        </div>
                        <div class="icon">
                            <i class="ion-ios-book"></i>
                        </div>
                        <a href="{{ route('riwayatpasien') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
