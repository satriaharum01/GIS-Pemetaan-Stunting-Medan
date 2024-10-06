@extends('template.header')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Pendapatan Hari Ini Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Puskesmas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$upt}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hospital fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pendapatan Bulan Ini Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Balita Sangat Pendek</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$sp_upt}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-disease fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pendapatan Bulan Ini Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Balita Pendek
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$p_upt}}</div>
                                </div>
                                <div class="col">
                                    <!-- Disabled Feature ->
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <-- Disabled Feature -->
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-disease fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Kecamatan Stunting tertingi </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$upt_rank}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hospital fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Stunting </h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="Area1"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"> Grafik Stunting Kecamatan</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="Area2"></canvas>
                    </div>
                    <!-- Card Body -->
                    <div class="text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-danger"></i> Sangat Pendek
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-warning"></i> Pendek
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"> Grafik Stunting Puskesmas ( 10 )</h6>
                    <a class="btn btn-danger float-right" href="{{url('/data/laporan/cetak')}}"><i class="fa fa-print"></i> Cetak</a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="Area3"></canvas>
                    </div>
                    <!-- Card Body -->
                    <div class="text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-danger"></i> Sangat Pendek
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-warning"></i> Pendek
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
@endsection

@section('custom_script')
<script src="{{ asset('assets/js/dashboard-chart-area.js') }}"></script>
<script>
    $(function() {

        // Area Chart Example
        var newlabel = <?= $labels ?>;
        var ctx = document.getElementById("Area1");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: newlabel,
                datasets: [{
                    label: "Balita",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: <?= $graph_area; ?>,
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 10,
                            padding: 10,
                            beginAtZero: true,
                            steps: 10,
                            stepValue: 5
                            /* Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return '' + number_format(value);
                            }*/
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ' : ' + number_format(tooltipItem.yLabel) + ' Balita';
                        }
                    }
                }
            }
        });

        var newData = <?= $newData ?>;
        var kecLabel = <?= $kecLabel ?>;
        var Area2 = document.getElementById("Area2");
        var SalesChart = new Chart(Area2, {
            type: 'bar',
            data: {
                labels: kecLabel,
                datasets: newData
            },
            options: {
                cornerRadius: 5,
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 20,
                        bottom: 0
                    }
                },
                scales: {
                    yAxes: [{
                        display: true,
                        gridLines: {
                            display: true,
                            drawBorder: false,
                            color: "#F2F2F2"
                        },
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            beginAtZero: true,
                            steps: 5,
                            stepValue: 2
                        }
                    }],
                    xAxes: [{
                        stacked: false,
                        ticks: {
                            callback: function(value, index, values) {
                                return '';
                            }
                        },
                        gridLines: {
                            color: "rgba(255, 255, 123, 133)",
                            display: false
                        },
                        barPercentage: 1
                    }]
                },
                legend: {
                    display: false
                },
                states: {
                    hover: {
                        brightness: 0.2,
                        color: '#ff0000'
                    }
                },
                elements: {
                    point: {
                        radius: 0
                    }
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ' : ' + tooltipItem.yLabel;
                        }
                    }
                }
            },
        });

        //Grafik Puskesmas
        var pusData = <?= $pusData ?>;
        var pusLabel = <?= $pusLabel ?>;
        var Area2 = document.getElementById("Area3");
        var SalesChart = new Chart(Area2, {
            type: 'bar',
            data: {
                labels: pusLabel,
                datasets: pusData
            },
            options: {
                cornerRadius: 5,
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 20,
                        bottom: 0
                    }
                },
                scales: {
                    yAxes: [{
                        display: true,
                        gridLines: {
                            display: true,
                            drawBorder: false,
                            color: "#F2F2F2"
                        },
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            beginAtZero: true,
                            steps: 5,
                            stepValue: 2
                        }
                    }],
                    xAxes: [{
                        stacked: false,
                        ticks: {
                            callback: function(value, index, values) {
                                return '';
                            }
                        },
                        gridLines: {
                            color: "rgba(255, 255, 123, 133)",
                            display: false
                        },
                        barPercentage: 1
                    }]
                },
                legend: {
                    display: false
                },
                states: {
                    hover: {
                        brightness: 0.2,
                        color: '#ff0000'
                    }
                },
                elements: {
                    point: {
                        radius: 0
                    }
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ' : ' + tooltipItem.yLabel;
                        }
                    }
                }
            },
        });
    });
</script>
</script>
@endsection