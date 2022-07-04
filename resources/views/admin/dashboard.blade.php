@extends('layouts.master')
@section('css')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
@section('header')
    <h2>Dashboard</h2>
@endsection
@section('content-top')
<div class="row">
    <div class="col-12">
        <div class="card widget-inline">
            <div class="card-body p-0">
                <div class="row g-0">
                    <div class="col-sm-6 col-xl-3">
                        <div class="card shadow-none m-0">
                            <div class="card-body text-center">
                                <i class="dripicons-briefcase text-muted" style="font-size: 24px;"></i>
                                <h3><span>{{ $supplier }}</span></h3>
                                <p class="text-muted font-15 mb-0">Total Supplier</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="card shadow-none m-0 border-start">
                            <div class="card-body text-center">
                                <i class="dripicons-checklist text-muted" style="font-size: 24px;"></i>
                                <h3><span>{{ $readyStock }}</span></h3>
                                <p class="text-muted font-15 mb-0">Barang Ready</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="card shadow-none m-0 border-start">
                            <div class="card-body text-center">
                                <i class="dripicons-graph-line text-muted" style="font-size: 24px;"></i>
                                <h3><span>{{ $emptyStock }}</span></h3>
                                <p class="text-muted font-15 mb-0">Barang Habis</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="card shadow-none m-0 border-start">
                            <div class="card-body text-center">
                                <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>
                                <h3><span>{{ $user->count() }}</span></h3>
                                <p class="text-muted font-15 mb-0">Total Akun</p>
                            </div>
                        </div>
                    </div>

                </div> <!-- end row -->
            </div>
        </div> <!-- end card-box-->
    </div> <!-- end col-->
</div>

<div class="mb-3 bg-white">
    <div class="row justify-content-center">
        <div class="col-md-4  pt-2 pb-3">
            <canvas id="user"></canvas>
        </div>
        <div class="col-md-4 pt-2 ">
            <canvas id="member"></canvas>
        </div>
        <div class="col-md-4 pt-2 ">
            <canvas id="stock"></canvas>
        </div>
    </div>
</div>
@endsection
@section('content')
    <div class="row">
        <canvas id="myChart"></canvas>
    </div>
@endsection
@section('js')
<script>
    var data = [];
    @foreach ($bm['data'] as $i)
        data.push('{{ $i }}')
    @endforeach
    var ctx = document.getElementById("myChart").getContext("2d");
    var data = {
        labels: data,
        datasets: [
            {
                label: "Request Barang Keluar Ditolak",
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgb(255, 99, 132)',
                borderWidht: '10',
                data: {{ json_encode($bm['rbt']) }}
            },
            {
                label: "Barang Masuk",
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgb(54, 162, 235)',
                borderWidht: '10',
                data: {{ json_encode($bm['bm']) }}
            },
            {
                label: "Request Barang Keluar Diterima",
                backgroundColor: 'rgba(0, 255, 30, 0.5)',
                borderColor: 'rgb(0, 255, 30)',
                borderWidht: '10',
                data: {{ json_encode($bm['rbs']) }}
            },
            // {
            //     label: "Sisa Barang",
            //     backgroundColor: 'rgba(255, 0, 204, 0.5)',
            //     borderColor: 'rgb(255, 0, 204)',
            //     borderWidht: '10',
            //     data: {{ json_encode($bm['sisa']) }}
            // }
        ]
    };

    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            barValueSpacing: 5,
            plugins: {
                title: {
                    display: true,
                    text: 'Report Data Barang Masuk Dan Keluar',
                },
                legend: {
                    display: true,
                    position: "bottom",
                }
            }
        }
    });
</script>
<script>
    var target1 = document.getElementById('user')
    var target2 = document.getElementById('member')
    var target3 = document.getElementById('stock')
    var data1 = {
            labels: [
                "Akun Aktif",
                "Akun Tidak Aktif",
                "Akun Admin",
                "Akun Member"
            ],
        datasets: [{
            data: [
                {{ $user->where('status','=','active')->count() }},
                {{ $user->where('status','=','non active')->count() }},
                {{ $user->where('role','=','admin')->count() }},
                {{ $user->where('role','=','member')->count() }}
            ],
            backgroundColor: [
                "#63FF84",
                "#FF6384",
                "#639fff",
                "#faff63"
            ]
        }]
    };
    var data2 = {
        labels: [
            "Barang Ready",
            "Barang Habis",
            "Total Jenis Barang"
        ],
        datasets: [
            {
                data: [
                    {{ $readyStock }},
                    {{ $emptyStock }},
                    {{ $readyStock + $emptyStock }}
                ],
                backgroundColor: [
                    "#63FF84",
                    "#FF6384",
                    "#639fff",
                ]
            }]
    };
            var targetLabel3 = []
                @foreach ($barang as $i)
                    targetLabel3.push('{{ $i->nama }}')
                @endforeach
            var targetData3 = []
                @foreach ($barang as $i)
                    targetData3.push('{{ $i->stock }}')
                @endforeach
    var data3 = {
        labels: targetLabel3,
        datasets: [
            {
                data: targetData3,
                backgroundColor: [
                    "#63FF84",
                    "#FF6384",
                    "#639fff",
                    "#fcb551",
                    "#fcfc51",
                    "#51fccf",
                    "#af51fc",
                    "#f642ff",
                ]
            }]
    };
    var options = {
        responsive: true,
        title: {
          display: true,
          position: "top",
          text: "Data User Dan Barang",
        },
        legend: {
          display: true,
          position: "bottom",
          labels: {
            fontColor: "#333",
            fontSize: 16
          }
        }
    };
    var pieChart1 = new Chart(target1, {
        type: 'pie',
        data: data1,
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Data Akun',
                },
                legend: {
                    display: true,
                    position: "bottom",
                }
            }
        }
    });
    var pieChart2 = new Chart(target2, {
        type: 'pie',
        data: data2,
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Data Barang',
                },
                legend: {
                    display: true,
                    position: "bottom",
                }
            }
        }
    });
    var pieChart3 = new Chart(target3, {
        type: 'pie',
        data: data3,
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Data Stock Barang',
                },
                legend: {
                    display: true,
                    position: "bottom",
                }
            }
        }
    });
</script>
@endsection