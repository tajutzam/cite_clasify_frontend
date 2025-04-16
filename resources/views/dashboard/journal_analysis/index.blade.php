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
                    <li class="breadcrumb-item text-white opacity-75">Analisa Journal</li>
                </ul>
            </div>
            <div class="d-flex align-items-center py-3 py-md-1">
                <a href="#" class="btn btn-bg-white btn-active-color-primary" data-bs-toggle="modal"
                    data-bs-target="#modal_analisa_id" id="button-analisa">Yuk, Cek Referensi Jurnal
                    Kamu!</a>
            </div>
        </div>
    </div>
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <div class="content flex-row-fluid" id="kt_content">
            <div class="row g-5 g-xxl-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">
                            <h2>Riwayat Journal</h2>
                        </div>
                        <div class="card-toolbar">
                            <div class="input-group input-group-solid w-250px">
                                <span class="input-group-text">
                                    <i class="fa fa-search"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Cari jurnal..."
                                    id="searchJournalInput">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <p class="text-muted">
                                Kamu belum pernah menganalisis jurnal apa pun.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" id="modal_analisa_id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Analisa Journal</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>

                <form action="{{ route('dashboard.journal.store') }}" id="analisa" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-4">
                            <label for="journalFile" class="form-label fw-semibold">Upload Jurnal (PDF)</label>
                            <div class="input-group input-group-solid">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa-solid fa-file-pdf text-danger"></i>
                                </span>
                                <input type="file" name="file" class="form-control" id="journalFile"
                                    aria-describedby="basic-addon1" accept="application/pdf" />
                            </div>
                            <div class="form-text">Hanya file <strong>.pdf</strong> yang diperbolehkan.</div>
                        </div>

                        <div class="mb-4">
                            <label for="journalTitle" class="form-label fw-semibold">Judul Jurnal</label>
                            <textarea class="form-control" id="journalTitle" rows="3" placeholder="Masukkan judul jurnal (opsional)"
                                data-kt-autosize="true" name="title"></textarea>
                            <p class="text-muted mt-2 small">
                                <i class="fa-solid fa-circle-info text-info me-1"></i>
                                Sistem akan mendeteksi judul otomatis jika kamu tidak mengisinya, namun untuk hasil yang
                                lebih akurat, sebaiknya masukkan judul secara manual.
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Analisa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
