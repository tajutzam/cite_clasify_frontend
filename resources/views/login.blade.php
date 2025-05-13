<!DOCTYPE html>
<html lang="en">

<head>
    <title>CiteClasify - Klasifikasi Sitasi Jurnal</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description"
        content="Login page for CiteClasify - Analyze your journal citations with machine learning." />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" />
</head>

<body id="kt_body" class="bg-body">
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!-- Aside -->
            <div class="d-flex flex-column flex-lg-row-auto w-xl-600px position-xl-relative"
                style="background-color: #F2C98A;">
                <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y px-10">
                    <div class="d-flex flex-column text-center p-10 pt-lg-20">
                        <a href="/" class="py-9 mb-5">
                            <img alt="Logo" src="{{ asset('landing/img/logo_cite.png') }}" class="h-60px" />
                        </a>
                        <p class="fw-bold fs-2 text-brown">
                            Ukur Kualitas Jurnal Kamu<br />dengan bantuan Machine Learning
                        </p>
                    </div>
                    <div class="d-flex flex-row-auto bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom min-h-100px min-h-lg-350px"
                        style="background-image: url('{{ asset('assets/media/illustrations/sketchy-1/13.png') }}');">
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="d-flex flex-column flex-lg-row-fluid py-10">
                <div class="d-flex flex-center flex-column flex-column-fluid">
                    <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                        <!-- Flash Messages -->
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Login Form -->
                        <form class="form w-100" method="post" action="{{ route('login.post') }}">
                            @csrf
                            <a href="{{ route('login.google') }}"
                                class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
                                <img alt="Google Icon"
                                    src="{{ asset('assets/media/svg/brand-logos/google-icon.svg') }}"
                                    class="h-20px me-3" />
                                Login atau Daftar dengan Google
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        var hostUrl = "{{ asset('assets/') }}";
    </script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
</body>

</html>
