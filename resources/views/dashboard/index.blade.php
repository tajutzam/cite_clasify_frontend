@extends('layouts.dashboard')

@section('content')
    @php
        $role = Auth::user()->role;
    @endphp

    <div class="toolbar py-5 py-lg-15" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <div class="page-title d-flex flex-column me-3">
                <h1 class="d-flex text-white fw-bold my-1 fs-2">Selamat Datang 👋</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <li class="breadcrumb-item text-white opacity-75">
                        <a href="{{ route('dashboard.index', ['id' => 1]) }}" class="text-white text-hover-light">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-white opacity-75">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>
    @if ($role == 'admin')
        <div id="kt_content_container" class="container-xxl py-10">
            <div class="content flex-row-fluid" id="kt_content">
                <div class="row g-5 g-xxl-8">
                    <div class="col-xxl-12 mb-4">
                        <div class="card card-xxl-stretch shadow-sm">
                            <div class="card-header py-5 bg-light-primary">
                                <h3 class="card-title text-primary fw-bolder fs-4 text-center w-100">
                                    📊 Statistik Publikasi Jurnal per Tahun
                                </h3>
                            </div>
                            <div class="card-body">
                                <div id="publicationYearChart" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4">
                        <div class="card card-xxl-stretch shadow-sm mb-5">
                            <div
                                class="card-body d-flex flex-column flex-md-row align-items-center justify-content-between">
                                <div class="me-4 mb-4 mb-md-0">
                                    <h2 class="fw-bold text-dark mb-2">Klasifikasi Kalimat Ilmiah</h2>
                                    <p class="text-muted mb-0">Analisis jurnal kamu secara otomatis dengan bantuan Machine
                                        Learning.</p>
                                </div>
                                <a href="{{ route('dashboard.analysis.index', ['id' => 1]) }}"
                                    class="btn btn-sm btn-primary fw-bold">
                                    Analisis
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4">
                        <div class="card bg-primary shadow-sm text-white text-center py-4">
                            <div class="card-body">
                                <img src="{{ asset('assets/media/svg/user-tick.svg') }}" alt="User"
                                    style="height: 40px;" class="mb-4">
                                <h2 class="fw-bold fs-1">{{ $user }}</h2>
                                <p class="fw-semibold fs-6">Total Pengguna</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4">
                        <div class="card bg-light shadow-sm text-center py-4">
                            <div class="card-body">
                                <img src="{{ asset('assets/media/svg/book-square.svg') }}" alt="Jurnal"
                                    style="height: 40px;" class="mb-4">
                                <h2 class="fw-bold text-dark fs-1">{{ $journals }}</h2>
                                <p class="fw-semibold text-muted fs-6">Total Jurnal</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div id="kt_content_container" class="container-xxl py-10">
            <div class="col-xxl-12">
                <div class="card card-xxl-stretch shadow-sm mb-5">
                    <div class="card-body d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="me-4 mb-4 mb-md-0">
                            <h2 class="fw-bold text-dark mb-2">Klasifikasi Kalimat Ilmiah</h2>
                            <p class="text-muted mb-0">Analisis jurnal kamu secara otomatis dengan bantuan Machine
                                Learning.</p>
                        </div>
                        <a href="{{ route('dashboard.analysis.index', ['id' => 1]) }}"
                            class="btn btn-sm btn-primary fw-bold">
                            Analisis
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @push('js')
        <script>
            var publicationData = @json($publicationData);

            var years = publicationData.map(item => item.publication_year);
            var counts = publicationData.map(item => item.count);

            var options = {
                chart: {
                    type: 'bar',
                    height: 300,
                    toolbar: {
                        show: false
                    },
                },
                series: [{
                    name: 'Jumlah Publikasi',
                    data: counts
                }],
                xaxis: {
                    categories: years,
                    title: {
                        text: 'Tahun',
                        style: {
                            fontWeight: 'bold'
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: 'Jumlah Publikasi',
                        style: {
                            fontWeight: 'bold'
                        }
                    }
                },
                colors: ['#3f86ff'],
                dataLabels: {
                    enabled: true
                },
                plotOptions: {
                    bar: {
                        borderRadius: 6,
                        horizontal: false,
                        columnWidth: '40%'
                    }
                },
                grid: {
                    borderColor: '#e7e7e7',
                    strokeDashArray: 4
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " publikasi";
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#publicationYearChart"), options);
            chart.render();
        </script>
    @endpush
@endsection
