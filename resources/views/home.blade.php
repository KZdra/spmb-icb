@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Dashboard') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-center">
                <div class="col-md-2">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $paymentStats->pending }}</h3>
                            <p>Pending</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $paymentStats->verified }}</h3>
                            <p>Verified</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $paymentStats->rejected }}</h3>
                            <p>Rejected</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{ $paymentStats->waiting_upload }}</h3>
                            <p>Waiting Upload</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-upload"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $paymentStats->waiting_cash }}</h3>
                            <p>Waiting Cash</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-text">Statistik Pendaftar Berdasarkan Jenis Kelamin Dan Jurusan</h2>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <canvas id="pendaftarChart" height="300"></canvas>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <canvas id="pendaftarChart2" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@section('scripts')
    <script type="module">
        $(document).ready(function() {

            const chartData = @json($chartData);
            const labels = chartData.map(item => item.jurusan);
            const maleData = chartData.map(item => item.total_male);
            const femaleData = chartData.map(item => item.total_female);
            const totalSiswa = chartData.map(item => item.total_male + item.total_female);
            const chart = {
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Laki-laki',
                            data: maleData,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Perempuan',
                            data: femaleData,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                config: {
                    chartId: 'pendaftarChart',
                    type: 'bar',
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top'
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.raw + " siswa";
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Jumlah Siswa'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Jurusan'
                                }
                            }
                        }
                    }
                }
            };
            const chart2 = {
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Siswa',
                        data: totalSiswa,
                        backgroundColor: [
                            '#36A2EB',
                            '#FF6384',
                            '#FFCE56',
                            '#4BC0C0',
                            '#9966FF',
                            '#FF9F40'
                        ],
                        borderColor: '#fff',
                        borderWidth: 2
                    }]
                },
                config: {
                    chartId: 'pendaftarChart2',
                    type: 'doughnut',
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            },
                            title: {
                                display: true,
                                text: 'Total Siswa per Jurusan'
                            }
                        }
                    }
                }
            };
            MakeChart(chart);
            MakeChart(chart2);

        });
    </script>
@endsection
@endsection
