@extends('layouts.main')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="container-fluid">
            <br>
            <h2>Dashboard Admin</h2>
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $obats }}</h3>
                            <p>Obat</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-nuclear"></i>
                        </div>
                        <a href="{{ route('obat') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
    </section>
@endsection
