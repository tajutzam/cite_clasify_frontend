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
            <div class="d-flex align-items-center py-3 py-md-1">
                <!--begin::Wrapper-->
                <!--end::Wrapper-->
                <!--begin::Button-->
                <a href="#" class="btn btn-bg-white btn-active-color-primary" data-bs-toggle="modal"
                    data-bs-target="#kt_modal_create_app" id="kt_toolbar_primary_button">Create</a>
                <!--end::Button-->
            </div>
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
                                <span class="card-label fw-bolder fs-3 mb-1">History Akurasi Model</span>
                            </h3>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body d-flex flex-column">
                            <!--begin::Chart-->
                            <div class="mixed-widget-5-chart card-rounded-top" data-kt-chart-color="success"
                                style="height: 150px"></div>
                            <!--end::Chart-->
                            <!--begin::Items-->
                            <div class="mt-5">
                                <!--begin::Item-->
                                <div class="d-flex flex-stack mb-5">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-2">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-50px me-3">
                                            <div class="symbol-label bg-light">
                                                <img src="{{ asset('/') }}assets/media/svg/brand-logos/plurk.svg"
                                                    class="h-50" alt="" />
                                            </div>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div>
                                            <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bolder">Top
                                                Authors</a>
                                            <div class="fs-7 text-muted fw-bold mt-1">Ricky Hunt, Sandra
                                                Trepp</div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Label-->
                                    <div class="badge badge-light fw-bold py-4 px-3">+82$</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex flex-stack mb-5">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-2">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-50px me-3">
                                            <div class="symbol-label bg-light">
                                                <img src="{{ asset('/') }}assets/media/svg/brand-logos/figma-1.svg"
                                                    class="h-50" alt="" />
                                            </div>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div>
                                            <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bolder">Top
                                                Sales</a>
                                            <div class="fs-7 text-muted fw-bold mt-1">PitStop Emails</div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Label-->
                                    <div class="badge badge-light fw-bold py-4 px-3">+82$</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-2">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-50px me-3">
                                            <div class="symbol-label bg-light">
                                                <img src="{{ asset('/') }}assets/media/svg/brand-logos/vimeo.svg"
                                                    class="h-50" alt="" />
                                            </div>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div class="py-1">
                                            <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bolder">Top
                                                Engagement</a>
                                            <div class="fs-7 text-muted fw-bold mt-1">KT.com</div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Label-->
                                    <div class="badge badge-light fw-bold py-4 px-3">+82$</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Items-->
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
                        <div class="col-xxl-3">
                            <!--begin::Tiles Widget 1-->
                            <div class="card h-150px bgi-no-repeat bgi-size-cover card-xxl-stretch"
                                style="background-image:url('{{ asset('/') }}assets/media/stock/600x400/img-75.jpg')">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <p class="text-gray-600 fs-5 mt-2">
                                        Waktu Saat Ini: <span id="real-time-clock"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-9">
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
                        <div class="col-xxl-6">
                            <!--begin::Tiles Widget 2-->
                            <div class="card h-175px bgi-no-repeat bgi-size-cover card-xxl-stretch mb-5 mb-xl-8"
                                style="background-color: #663259; background-position: calc(100% + 0.5rem) 100%;background-size: 100% auto;background-image:url('{{ asset('/') }}assets/media/svg/misc/taieri.svg')">
                                <!--begin::Body-->
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <!--begin::Title-->
                                    <h3 class="text-white fw-bolder line-height-lg mb-5">Buat laporan Journal
                                        <br />
                                    </h3>
                                    <!--end::Title-->
                                    <!--begin::Action-->
                                    <div class="m-0">
                                        <a href='#' class="btn btn-success fw-bold px-6 py-3" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_create_app">Generate</a>
                                    </div>
                                    <!--begin::Action-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Tiles Widget 2-->
                            <div class="row gx-5 gx-xl-8">
                                <!--begin::Col-->
                                <div class="col-xxl-6">
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
                                                8,600</div>
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
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xxl-6">
                            <!--begin::Mixed Widget 3-->
                            <div class="card h-100 bgi-no-repeat bgi-size-cover card-xxl-stretch mb-5 mb-xl-8"
                                style="background-image:url('{{ asset('/') }}assets/media/misc/bg-2.jpg')">
                                <!--begin::Body-->
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <!--begin::Title-->
                                    <div class="text-white fw-bolder fs-2">
                                        <h2 class="fw-bolder text-white mb-2">Create Reports</h2>With App
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Link-->
                                    <a href='#' class="text-warning fw-bold" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_create_app">Create Report
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                        <span class="svg-icon svg-icon-2 svg-icon-warning">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="18" y="13" width="13" height="2"
                                                    rx="1" transform="rotate(-180 18 13)" fill="black" />
                                                <path
                                                    d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon--></a>
                                    <!--end::Link-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Mixed Widget 3-->
                        </div>
                        <!--end::Col-->
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

        // Perbarui setiap 1 detik
        setInterval(updateClock, 1000);

        // Jalankan saat halaman dimuat
        updateClock();
    </script>
@endsection
