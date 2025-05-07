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
                    data-bs-target="#modal_intro_cek_jurnal" id="button-analisa">
                    Yuk, Cek Referensi Jurnal Kamu!
                </a>
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
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                                <form action="" method="get">
                                    <input type="text" name="title" class="form-control" placeholder="Cari jurnal..."
                                        id="searchJournalInput">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if ($data->isEmpty())
                                <div class="col-12 text-center">
                                    <p class="text-muted">Kamu belum pernah menganalisis jurnal apa pun.</p>
                                </div>
                            @else
                                @foreach ($data as $journal)
                                    <div class="col-md-4 col-sm-6 mb-4">
                                        <div class="card shadow-sm h-100">
                                            <div class="card-body d-flex flex-column">
                                                <h6 class="card-title text-truncate" title="{{ $journal->title }}">
                                                    {{ $journal->title ?? 'Tanpa Judul' }}
                                                </h6>
                                                <p class="mb-2 text-muted small">
                                                    Diunggah:
                                                    {{ \Carbon\Carbon::parse($journal->created_at)->diffForHumans() }}
                                                </p>
                                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                                    <a href="{{ env('BACKEND_URL') . '/' . $journal->pdf }}" target="_blank"
                                                        class="btn btn-sm btn-light-primary">
                                                        <i class="fas fa-eye me-1"></i> Lihat PDF
                                                    </a>
                                                    <a href="{{ route('dashboard.journal.show', ['id' => $journal->id]) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fas fa-chart-line me-1"></i> Lihat Analisis
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal #1: Edukasi / Intro --}}
    {{-- Modal #1: Edukasi / Intro --}}
    <div class="modal fade" tabindex="-1" id="modal_intro_cek_jurnal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Analisa Jornal</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"></i>
                    </div>
                </div>
                <div class="modal-body">
                    <form id="checkJudul" method="post">
                        <div class="mb-4">
                            <label for="journalFile" class="form-label fw-semibold">Upload Jurnal (PDF)</label>
                            <div class="input-group input-group-solid">
                                <span class="input-group-text"><i class="fa-solid fa-file-pdf text-danger"></i></span>
                                <input type="file" name="file" class="form-control" id="journalFile"
                                    accept="application/pdf" />
                            </div>
                            <div class="form-text">Hanya file <strong>.pdf</strong> yang diperbolehkan.</div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="btnLanjutKeAnalisa">Lanjut</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal #2: Upload PDF dan judul --}}
    <div class="modal fade" tabindex="-1" id="modal_analisa_id">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Analisa Journal</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"></i>
                    </div>
                </div>
                <form action="{{ route('dashboard.journal.store') }}" id="analisa" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-4">
                            <label for="journalTitle" class="form-label fw-semibold">Judul Jurnal</label>
                            <textarea class="form-control" id="journalTitle" rows="3" placeholder="Masukkan judul jurnal (opsional)"
                                data-kt-autosize="true" name="title"></textarea>
                            <p class="text-muted mt-2 small">
                                <i class="fa-solid fa-circle-info text-info me-1"></i>
                                Jika Judul belum sesuai
                            </p>
                        </div>

                        <!-- File input disembunyikan tapi dikirim -->
                        <input type="file" name="file" id="hiddenJournalFile" hidden>

                        <!-- PDF Preview -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Pratinjau PDF</label>
                            <iframe id="pdfPreview" src="" class="w-100" height="400px"></iframe>
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
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btnLanjut = document.getElementById('btnLanjutKeAnalisa');

            btnLanjut.addEventListener('click', function() {
                const fileInput = document.getElementById('journalFile');
                const file = fileInput.files[0];

                if (!file) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'File belum dipilih!',
                        text: 'Silakan pilih file PDF terlebih dahulu.'
                    });
                    return;
                }

                const formData = new FormData();
                formData.append('file', file);

                // Tampilkan loading swal
                Swal.fire({
                    title: 'Mengambil judul...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                fetch("{{ env('BACKEND_URL') }}/title-checker", {
                        method: 'POST',
                        body: formData
                    })
                    .then(async response => {
                        if (!response.ok) throw new Error("Gagal mengirim file ke server.");
                        return response.json();
                    })
                    .then(data => {
                        Swal.close(); // Tutup loading swal

                        const title = data.title || "";
                        document.getElementById('journalTitle').value = title;

                        // Setel preview PDF
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const preview = document.getElementById('pdfPreview');
                            preview.src = e.target.result;

                            // Clone file ke form kedua
                            const hiddenFileInput = document.getElementById('hiddenJournalFile');
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(file);
                            hiddenFileInput.files = dataTransfer.files;

                            // Pindah ke modal analisa
                            const modalIntro = bootstrap.Modal.getInstance(document.getElementById(
                                'modal_intro_cek_jurnal'));
                            modalIntro.hide();

                            const modalAnalisa = new bootstrap.Modal(document.getElementById(
                                'modal_analisa_id'));
                            setTimeout(() => modalAnalisa.show(), 300);
                        };
                        reader.readAsDataURL(file);
                    })
                    .catch(error => {
                        console.error(error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal mengambil judul',
                            text: 'Terjadi kesalahan saat mengambil judul. Coba lagi.'
                        });
                    });
            });

            // submit fetch
            const form = document.getElementById('analisa');
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Jangan submit default

                const formData = new FormData(form);
                const file = formData.get('file');

                if (!file || file.size === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'File belum dipilih!',
                        text: 'Silakan pilih file PDF terlebih dahulu.'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Mengirim data...',
                    text: 'Mohon tunggu, sedang mengirim jurnal untuk analisa.',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                fetch("{{ route('dashboard.journal.store') }}", {
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: formData
                    })
                    .then(async response => {
                        const data = await response.json();

                        if (!response.ok) {
                            throw new Error(data.message || 'Gagal menganalisis jurnal');
                        }

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Jurnal berhasil dianalisis.'
                        }).then(() => {
                            location.reload(); // Reload page after success
                        });
                    })
                    .catch(error => {
                        console.error(error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: error.message || 'Terjadi kesalahan saat analisa jurnal.'
                        });
                    });
            });
        });
    </script>
@endpush
