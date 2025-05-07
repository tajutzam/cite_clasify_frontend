<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('landing') }}/img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="colorlib">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Cite Clasify</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('landing') }}/css/linearicons.css">
    <link rel="stylesheet" href="{{ asset('landing') }}/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('landing') }}/css/bootstrap.css">
    <link rel="stylesheet" href="{{ asset('landing') }}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('landing') }}/css/nice-select.css">
    <link rel="stylesheet" href="{{ asset('landing') }}/css/animate.min.css">
    <link rel="stylesheet" href="{{ asset('landing') }}/css/owl.carousel.css">
    <link rel="stylesheet" href="{{ asset('landing') }}/css/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('landing') }}/css/main.css">
</head>

<body>
    <header id="header" id="home">
        <div class="container main-menu">
            <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <a href="index.html">
                        <img src="{{ asset('landing') }}/img/logo_cite.png" style="height: 20px" alt=""
                            title="Logo" />
                    </a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li><a href="{{ url('/', []) }}" style="margin-top: 10px">Home</a></li>
                        <li><a href="{{ url('/journals') }}" style="margin-top: 10px">Journal Diunggah</a></li>
                        <li><a href="{{ url('/login') }}" class="primary-btn rounded-md">Login</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
