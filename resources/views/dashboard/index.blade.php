@extends('layouts.dashboard')

@section('content')
    <div class="toolbar py-5 py-lg-15" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <div class="page-title d-flex flex-column me-3">
                <h1 class="d-flex text-white fw-bolder my-1 fs-3">Dashboard</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <li class="breadcrumb-item text-white opacity-75">
                        <a href="{{ route('dashboard.index', ['id' => 1]) }}" class="text-white text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-white opacity-75">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <div class="content flex-row-fluid" id="kt_content">
            <div class="row g-5 g-xxl-8">
                @if (auth()->user()->role == 'admin')
                    <div class="col-xxl-4 mb-4 mb-xxl-0">
                        <div class="card card-xxl-stretch mb-xl-3 shadow-sm">
                            <div class="card-header border-0 py-5">
                                <h3 class="card-title align-items-start flex-column text-center">
                                    <span class="card-label fw-bolder fs-4 mb-1 text-primary">Referensi Jurnal Scopus
                                        Berdasarkan Tahun Publikasi</span>
                                </h3>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div id="publicationYearChart" class="card-rounded-top" style="height: 200px"></div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-xxl-12">
                    <div class="card card-xxl-stretch shadow-sm mb-4">
                        <div class="card-body d-flex align-items-center justify-content-between flex-wrap">
                            <div class="me-2">
                                <h1 class="fw-bolder text-gray-800 mb-3">Selamat Datang di Website Klasifikasi Jurnal</h1>
                                <h2 class="fw-bolder text-gray-800 mb-3">Klasifikasi Kalimat Ilmiah</h2>
                                <div class="text-muted fw-bold fs-6">Analisis jurnalmu dengan bantuan Machine Learning
                                    sekarang</div>
                            </div>
                            <a href="{{ route('dashboard.analysis.index', ['id' => 1]) }}"
                                class="btn btn-primary fw-bold mt-2">Mulai Analisis</a>
                        </div>
                    </div>

                    @if (auth()->user()->role == 'admin')
                        <div class="row gx-5 gx-xl-8 mb-5 mb-xl-8">
                            <div class="col-xxl-6 mb-3">
                                <a href="#" class="card bg-primary card-xxl-stretch shadow-sm">
                                    <div class="card-body text-center">
                                        <img src="{{ asset('') }}assets/media/svg/user-tick.svg" alt=""
                                            style="height: 40px; filter: invert(29%) sepia(95%) saturate(285%) hue-rotate(180deg);">
                                        <div class="text-white fw-bolder fs-1 mb-2 mt-5">{{ $user }}</div>
                                        <div class="fw-bold text-white fs-6">Total Pengguna</div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xxl-6">
                                <a href="#" class="card bg-light card-xxl-stretch shadow-sm">
                                    <div class="card-body text-center">
                                        <img src="{{ asset('') }}assets/media/svg/book-square.svg" alt=""
                                            style="height: 40px">
                                        <div class="text-gray-800 fw-bolder fs-1 mb-2 mt-5">{{ $journals }}</div>
                                        <div class="fw-bold text-gray-800 fs-6">Total Jurnal</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateClock() {
            let now = new Date();
            let hours = now.getHours().toString().padStart(2, '0');
            let minutes = now.getMinutes().toString().padStart(2, '0');
            let seconds = now.getSeconds().toString().padStart(2, '0');
            let formattedTime = `${hours}:${minutes}:${seconds}`;
            document.getElementById('real-time-clock').textContent = formattedTime;
        }

        setInterval(updateClock, 1000);
        updateClock();
    </script>

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
                    background: '#f5f5f5'
                },
                series: [{
                    name: 'Jumlah Publikasi',
                    data: counts
                }],
                xaxis: {
                    categories: years,
                    title: {
                        text: 'Tahun'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Jumlah'
                    }
                },
                colors: ['#50cd89'],
                dataLabels: {
                    enabled: true
                },
                plotOptions: {
                    bar: {
                        borderRadius: 8,
                        horizontal: false
                    }
                },
                grid: {
                    show: true
                }
            };

            var chart = new ApexCharts(document.querySelector("#publicationYearChart"), options);
            chart.render();
        </script>
    @endpush
@endsection
