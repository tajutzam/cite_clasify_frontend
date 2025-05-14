@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <section class="info-area section-gap">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-40 col-lg-10">
                    <div class="title text-center">
                        <h1 class="mb-10">Klasifikasi Sumber Sitasi Jurnal</h1>
                        <p>
                            Kami membantu Anda dalam mengklasifikasikan sumber-sumber yang digunakan dalam jurnal Anda ke
                            dalam tiga kelas utama, yaitu <strong>Background</strong>, <strong>Method</strong>, dan
                            <strong>Result</strong>.
                            Klasifikasi ini dilakukan secara otomatis menggunakan teknologi <i>Natural Language
                                Processing</i> (NLP) dan pembelajaran mesin, untuk memberikan pemahaman yang lebih dalam
                            terhadap kualitas referensi jurnal Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="feature-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-feature">
                        <div class="title" style="background-color: orange">
                            <h4>Background</h4>
                        </div>
                        <div class="desc-wrap">
                            <p>
                                Kelas ini mengidentifikasi dasar teori dan referensi yang digunakan dalam penelitian.
                                Biasanya ditempatkan pada <strong>bagian Pendahuluan (Introduction)</strong> dalam artikel
                                atau jurnal ilmiah. Bagian ini memberikan konteks dan menjelaskan mengapa penelitian ini
                                penting, serta menggambarkan penelitian sebelumnya yang relevan.
                            </p>
                            <a href="#">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>

                <!-- Method Section -->
                <div class="col-lg-4">
                    <div class="single-feature">
                        <div class="title" style="background-color: orange">
                            <h4>Method</h4>
                        </div>
                        <div class="desc-wrap">
                            <p>
                                Kelas ini berisi metode dan pendekatan yang digunakan dalam penelitian, seperti eksperimen
                                atau algoritma. Biasanya ditempatkan pada <strong>bagian Metode (Methods)</strong> setelah
                                bagian Pendahuluan. Bagian ini menjelaskan cara penelitian dilakukan, teknik yang digunakan,
                                serta instrumen atau bahan yang dipakai.
                            </p>
                            <a href="#">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="single-feature">
                        <div class="title" style="background-color: orange">
                            <h4>Result</h4>
                        </div>
                        <div class="desc-wrap">
                            <p>
                                Kelas ini menampilkan hasil penelitian serta analisis dari eksperimen yang dilakukan.
                                Biasanya ditempatkan pada <strong>bagian Hasil (Results)</strong>, setelah Metode. Bagian
                                ini menyajikan data yang diperoleh dalam bentuk tabel, grafik, atau deskripsi, tanpa
                                interpretasi mendalam, yang akan dibahas lebih lanjut di bagian Diskusi.
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
                    <a class="primary-btn wh" href="/dashboard">Unggah Jurnal</a>
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
                        <p>Top Journal Berdasarkan SCImago Journal Rank (SJR) Pada Penyimpanan Cite ClasifyS</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($scopuses as $journal)
                    <div class="col-lg-3 col-md-6 single-journal mb-4">
                        <div class="thumb d-flex justify-content-center align-items-center"
                            style="height: 150px; background-color: #f8f9fa;">
                            <i class="fa-solid fa-book"></i>
                        </div>

                        <p class="meta">SJR Score: <strong>{{ $journal->sjr }}</strong></p>
                        <h5 class="text-ellipsis text-truncate">{{ $journal->title }}</h5>

                        @if (!empty($journal->doi))
                            <a href="https://doi.org/{{ $journal->doi }}" target="_blank"
                                class="details-btn d-flex justify-content-center align-items-center mt-2">
                                <span class="details">Lihat Doi</span>
                                <span class="lnr lnr-arrow-right"></span>
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection
