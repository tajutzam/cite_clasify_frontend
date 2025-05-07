@extends('layouts.dashboard')

@section('content')
    <div class="toolbar py-5 py-lg-15" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column me-3">
                <!--begin::Title-->
                <h1 class="d-flex text-white fw-bolder my-1 fs-3">Dashboard</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-white opacity-75">
                        <a href="{{ route('dashboard.index', ['id' => 1]) }}" class="text-white text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-white opacity-75">Dashboard</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <!--end::Actions-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Container-->
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <!--begin::Post-->
        <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Row-->
            <div class="row g-5 g-xxl-8">
                <!--begin::Col-->
                <div class="col-xxl-4">
                    <!--begin::Mixed Widget 5-->
                    <div class="card card-xxl-stretch mb-xl-3">
                        <!--begin::Beader-->
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1 text-center">Referensi Jurnal Scopus Berdasarkan
                                    Tahun
                                    Publikasi</span>
                            </h3>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body d-flex flex-column">
                            <!-- Chart Container -->
                            <div id="publicationYearChart" class="card-rounded-top" style="height: 150px"></div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Mixed Widget 5-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xxl-8">
                    <!--begin::Row-->
                    <div class="row gx-5 gx-xl-8 mb-5 mb-xl-8">
                        <div class="col-xxl-12">
                            <div class="card h-150px card-xxl-stretch">
                                <!--begin::Body-->
                                <div class="card-body d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="me-2">
                                        <h2 class="fw-bolder text-gray-800 mb-3">Klasifikasi Kalimat Ilmiah</h2>
                                        <div class="text-muted fw-bold fs-6">Analiss journal mu dengan bantuan Machine
                                            Learning Sekarang</div>
                                    </div>
                                    <a href="{{ route('dashboard.analysis.index', ['id' => 1]) }}"
                                        class="btn btn-primary fw-bold mt-2">Mulai Analisis</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="row gx-5 gx-xl-8 mb-5 mb-xl-8">
                        <!--begin::Col-->
                        <div class="row gx-5 gx-xl-8">
                            <!--begin::Col-->
                            <div class="col-xxl-6 mb-3">
                                <!--begin::Tiles Widget 5-->
                                <a href="#" class="card bg-primary card-xxl-stretch">
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <img src="{{ asset('') }}assets/media/svg/user-tick.svg" alt=""
                                            style="height: 40px; filter: invert(29%) sepia(95%) saturate(285%) hue-rotate(180deg);">
                                        <div class="text-inverse-primary fw-bolder fs-1 mb-2 mt-5">{{ $user }}
                                        </div>
                                        <div class="fw-bold text-inverse-primary fs-6">Total Pengguna
                                        </div>
                                    </div>
                                    <!--end::Body-->
                                </a>
                                <!--end::Tiles Widget 5-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xxl-6">
                                <!--begin::Tiles Widget 5-->
                                <a href="#" class="card bg-bg-body card-xxl-stretch">
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <img src="{{ asset('') }}assets/media/svg/book-square.svg" alt=""
                                            style="height: 40px">
                                        <div class="text-inverse-bg-body fw-bolder fs-1 mb-2 mt-5">
                                            {{ $journals }}</div>
                                        <div class="fw-bold text-inverse-bg-body fs-6">Total Journal
                                        </div>
                                    </div>
                                    <!--end::Body-->
                                </a>
                                <!--end::Tiles Widget 5-->
                            </div>
                            <!--end::Col-->
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Post-->
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
                    }
                },
                series: [{
                    name: 'Jumlah Publikasi',
                    data: counts // Jumlah publikasi
                }],
                xaxis: {
                    categories: years, // Tahun publikasi
                    title: {
                        text: 'Tahun'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Jumlah'
                    }
                },
                colors: ['#50cd89'], // Warna "success"
                dataLabels: {
                    enabled: true
                }
            };

            var chart = new ApexCharts(document.querySelector("#publicationYearChart"), options);
            chart.render();
        </script>
    @endpush
@endsection
