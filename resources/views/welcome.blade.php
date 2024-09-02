@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0">Dashboard</h5>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>Rs. {{ number_format($todayCollection, 0, '.', ',') }}/-</h3>

                            <p>Todays Collection</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-12">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>Rs. {{ number_format($thisMonthCollection, 0, '.', ',') }}<sup style="font-size: 20px">/-</sup></h3>

                            <p>This Month Collection</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-12">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>Rs. {{ number_format($thisYearCollection, 0, '.', ',') }}/-</h3>

                            <p>This Year Collection</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-12">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $totalCustomer }} / {{ $totalAgents }}</h3>

                            <p>Total Customer / Agents</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ route('agents.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
