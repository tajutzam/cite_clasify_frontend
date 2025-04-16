@extends('layouts.app')
@section('content')
    <section class="banner-area relative" id="home">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row fullscreen d-flex align-items-center justify-content-between">
                <div class="banner-content col-lg-9 col-md-12">
                    <h1 class="text-uppercase">
                        Analisis & Klasifikasi Sitasi Jurnal
                    </h1>
                    <p class="pt-10 pb-10">
                        Evaluasi kualitas jurnal berdasarkan pola sitasi dengan teknologi NLP dan machine learning.
                        Unggah jurnal Anda dan temukan wawasan mendalam dari sitasi yang terkandung di dalamnya.
                    </p>
                    <a href="#" class="primary-btn text-uppercase">Mulai Sekarang</a>
                </div>
            </div>
        </div>
    </section>

    <section class="feature-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-feature">
                        <div class="title">
                            <h4>Background</h4>
                        </div>
                        <div class="desc-wrap">
                            <p>
                                Kelas yang mengidentifikasi dasar teori dan referensi yang digunakan dalam penelitian.
                            </p>
                            <a href="#">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
                <!-- Method Section -->
                <div class="col-lg-4">
                    <div class="single-feature">
                        <div class="title">
                            <h4>Method</h4>
                        </div>
                        <div class="desc-wrap">
                            <p>
                                Kelas yang berisi metode dan pendekatan yang digunakan dalam penelitian, seperti
                                eksperimen atau
                                algoritma.
                            </p>
                            <a href="#">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-feature">
                        <div class="title">
                            <h4>Result</h4>
                        </div>
                        <div class="desc-wrap">
                            <p>
                                Kelas yang Menampilkan hasil penelitian serta analisis dari eksperimen yang dilakukan.
                            </p>
                            <a href="#">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="cta-one-area relative section-gap mb-5">
        <div class="container">
            <div class="overlay overlay-bg"></div>
            <div class="row justify-content-center">
                <div class="wrap text-center">
                    <h1 class="text-white">Klasifikasikan Jurnal Anda</h1>
                    <p>
                        Unggah jurnal Anda dan analisis klasifikasi sitasi berdasarkan kategori <b>Background</b>,
                        <b>Method</b>, dan <b>Result</b>.
                        Pastikan jurnal Anda memiliki keseimbangan dalam ketiga aspek ini untuk meningkatkan
                        kualitasnya.
                    </p>
                    <a class="primary-btn wh" href="#">Unggah Jurnal</a>
                </div>
            </div>
        </div>
    </section>

    <section class="journal-ranking section-gap" id="ranking">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-70 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">Journal Ranking (SJR)</h1>
                        <p>Top journals based on SCImago Journal Rank (SJR).</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @php
                    $journals = [
                        [
                            'title' => 'Journal of AI Research',
                            'sjr' => 2.5,
                            'description' => 'A top-tier journal in AI research.',
                        ],
                        [
                            'title' => 'Machine Learning Review',
                            'sjr' => 2.3,
                            'description' => 'Covers latest trends in machine learning.',
                        ],
                        [
                            'title' => 'Neural Networks & Deep Learning',
                            'sjr' => 2.1,
                            'description' => 'Focuses on neural networks advances.',
                        ],
                        [
                            'title' => 'Data Science Journal',
                            'sjr' => 1.9,
                            'description' => 'Publishes innovative data science studies.',
                        ],
                    ];
                @endphp

                @foreach ($journals as $journal)
                    <div class="col-lg-3 col-md-6 single-journal">
                        <div class="thumb">
                            <img class="img-fluid" src="{{ asset('landing/img/journal-placeholder.jpg') }}" alt="">
                        </div>
                        <p class="meta">SJR Score: <strong>{{ $journal['sjr'] }}</strong></p>
                        <h5>{{ $journal['title'] }}</h5>
                        <p>{{ $journal['description'] }}</p>
                        <a href="#" class="details-btn d-flex justify-content-center align-items-center">
                            <span class="details">Details</span><span class="lnr lnr-arrow-right"></span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
