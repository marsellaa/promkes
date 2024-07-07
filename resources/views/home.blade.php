@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>

    @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">PEH (Bulan ini)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['pehCountThisMonth'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hospital fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Health Talk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['healthtalk'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-heartbeat fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Donor Darah</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['donordarah'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tint fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Donor Darah</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $widget['donordarah'] }}%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Users -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">{{ __('User') }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['users'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Feedback</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['feedback'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-pencil-square fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Kerja Sama Non BPJS</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['kerjasamanonbpjs'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-handshake fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Kunjungan Mitra</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['kjmitra'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-link fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Info dan Komplain</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['infodankomplain'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-info fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Flyer</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['flyer'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{ __('Video') }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['video'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-play fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tambahkan row baru di sini untuk presentase -->
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Presentase</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Persentase PEH Terlaksana -->
                        <div class="col-xl-6 col-md-12 mb-4">
                            <div class="card shadow py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Persentase PEH Terlaksana</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($widget['pehYaPercentage'], 2) }}%</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chart-pie fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                    <canvas id="pehChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Persentase HealthTalk Terlaksana -->
                        <div class="col-xl-6 col-md-12 mb-4">
                            <div class="card shadow py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Persentase HealthTalk Terlaksana</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($widget['healthTalkYaPercentage'], 2) }}%</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chart-pie fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                    <canvas id="healthTalkChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // PEH Chart
        var pehCtx = document.getElementById('pehChart').getContext('2d');
        var pehChart = new Chart(pehCtx, {
            type: 'doughnut',
            data: {
                labels: ['Terlaksana', 'Tidak Terlaksana', 'Pending'],
                datasets: [{
                    data: [<?php echo number_format($widget["pehYaPercentage"], 2) ?>, <?php echo number_format($widget["pehTidakPercentage"], 2) ?>, <?php echo number_format($widget["pehPendingPercentage"],2)?>],
                    backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205,86)'],
                    hoverBorderColor: 'rgba(234, 236, 244, 1)',
                }],
            },
            
        });

        // HealthTalk Chart
        var healthTalkCtx = document.getElementById('healthTalkChart').getContext('2d');
        var healthTalkChart = new Chart(healthTalkCtx, {
            type: 'doughnut',
            data: {
                labels: ['Terlaksana', 'Tidak Terlaksana', 'Pending'],
                datasets: [{
                    data: [<?php echo number_format($widget["healthTalkYaPercentage"], 2) ?>, <?php echo number_format($widget["healthTalkTidakPercentage"], 2) ?>, <?php echo number_format($widget["healthTalkPendingPercentage"],2)?>],
                    backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205,86)'],
                    hoverBorderColor: 'rgba(234, 236, 244, 1)',
                }],
            },
            
        });
    });
</script>
@endpush
