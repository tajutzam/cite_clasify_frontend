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
                    <li class="breadcrumb-item text-white opacity-75">
                        <a href="{{ route('dashboard.journal.index', ['id' => 1]) }}"
                            class="text-white text-hover-primary">Analisa Journal</a>

                    </li>
                    <li class="breadcrumb-item text-white opacity-100 ">Hasil Analisa</li>

                </ul>
            </div>
        </div>
    </div>
    <div id="kt_content_container" class="container-xxl d-flex flex-column-fluid align-items-start">
        <div class="content flex-row-fluid" id="kt_content">
            <div class="row g-5 g-xxl-8">

                <div class="col-12">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
                            <h2 class="card-title mb-0">Detail Jurnal</h2>
                            <div class="d-flex align-items-center py-3 py-md-1">
                                <form action="{{ route('dashboard.journal.destroy', ['id' => $journal->id]) }}"
                                    method="post" class="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-active-color-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </div>
                        <div class="card-body">
                            <p class="mb-2"><strong>Judul:</strong> {{ $journal->title }}</p>
                            <p class="mb-2 text-muted small">
                                <strong>Diunggah:</strong>
                                {{ \Carbon\Carbon::parse($journal->created_at)->diffForHumans() }}
                            </p>
                            <p class="mb-0 text-muted small d-flex align-items-center">
                                <strong>Oleh:</strong>
                                <span class="ms-2">{{ $journal->user->email }}</span>
                                <img class="h-30px w-30px rounded-circle ms-2"
                                    src="@if ($journal->user->is_google_account) {{ auth()->user()->image }} @else {{ asset('/') }}assets/media/avatars/150-25.jpg @endif"
                                    alt="User Avatar" />
                            </p>
                        </div>
                    </div>
                </div>

                {{-- CARD: Daftar Kalimat Prediksi --}}
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex gap-4">
                                <button class="btn btn-primary btn-sm mb-4" data-bs-toggle="modal"
                                    data-bs-target="#pdfModal">
                                    <i class="fas fa-file-pdf me-2"></i> Lihat PDF
                                </button>

                                <button class="btn btn-secondary btn-sm mb-4" data-bs-toggle="modal"
                                    data-bs-target="#scopusModal">
                                    <i class="fas fa-book-reader me-2"></i> Lihat Index Scopus
                                </button>
                            </div>

                            <div id="pieChartDiv" style="width: 100%; height: 400px;"></div>

                            <div class="row mt-4">
                                <div class="col-lg-12 col-md-12">
                                    <div class="p-3 border rounded bg-light h-100">
                                        <h5 class="mb-4">Daftar Kalimat Yang Sudah Diprediksi</h5>

                                        <!-- Table for DataTable -->
                                        <table id="citationSentencesTable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Label</th>
                                                    <th>Kalimat</th>
                                                    <th>Akurasi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($citationSentences as $sentence)
                                                    @php
                                                        $label = match ($sentence->label) {
                                                            '1' => ['text' => 'Method', 'class' => 'badge bg-primary'],
                                                            '2' => ['text' => 'Result', 'class' => 'badge bg-success'],
                                                            default => [
                                                                'text' => 'Background',
                                                                'class' => 'badge bg-secondary text-dark',
                                                            ],
                                                        };
                                                    @endphp
                                                    <tr>
                                                        <td><span class="{{ $label['class'] }}">{{ $label['text'] }}</span>
                                                        </td>
                                                        <td>{{ $sentence->text }}</td>
                                                        <td style="max-width: 30px">
                                                            {{ number_format($sentence->accuracy * 100, 2) }}%</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center text-muted">Belum ada kalimat
                                                            yang dianalisis.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <div class="">
                                            {{ $citationSentences->links() }}
                                        </div>
                                    </div>

                                </div>
                            </div> {{-- end row --}}
                        </div> {{-- end card-body --}}
                    </div>
                </div>

            </div> {{-- end row --}}
        </div>
    </div>


    <div class="modal fade" tabindex="-1" id="scopusModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Index Scopus</h3>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    @if ($journal->scopus_references->isEmpty())
                        <div class="badge-danger w-full px-3 py-2 rounded mb-2">
                            <p>Jurnal ini <strong>tidak terindeks</strong> di Scopus.</p>
                        </div>
                    @else
                        <div class="badge-success w-full px-3 py-2 rounded mb-2">
                            <p>Jurnal ini terindeks di Scopus dengan beberapa referensi berikut:</p>
                        </div>
                        <div class="row">
                            @foreach ($journal->scopus_references as $reference)
                                <div class="col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <strong>{{ $reference->publication_name }}</strong>
                                            ({{ $reference->publication_year }})
                                        </div>
                                        <div class="card-body shadow-md">
                                            <p><strong>Authors:</strong> {{ $reference->authors }}</p>
                                            <p><strong>Title:</strong> {{ $reference->title }}</p>
                                            <p><strong>DOI:</strong> <a href="https://doi.org/{{ $reference->doi }}"
                                                    target="_blank">{{ $reference->doi }}</a></p>
                                            <p><strong>Cite Score:{{ $reference->cite_score ?? '-' }}</p>
                                            <p><strong>SJR Score:{{ $reference->sjr ?? '-' }}</p>
                                            <p><strong>SNP Score:{{ $reference->snp ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>





    {{-- Modal PDF --}}
    <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">Lihat PDF Jurnal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Tempat PDF akan tampil --}}
                    <embed src="{{ env('BACKEND_URL') . '/' . $journal['pdf'] }}" type="application/pdf" width="100%"
                        height="500px" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            // Menghitung jumlah setiap label
            let methodCount = 0;
            let resultCount = 0;
            let backgroundCount = 0;

            @foreach ($journal->citation_sentences as $sentence)
                @php
                    $label = $sentence->label;
                @endphp

                if ("{{ $label }}" === "1") {
                    methodCount++;
                } else if ("{{ $label }}" === "2") {
                    resultCount++;
                } else {
                    backgroundCount++;
                }
            @endforeach

            // Data untuk Pie Chart
            am5.ready(function() {
                // Membuat root untuk chart
                var root = am5.Root.new("pieChartDiv");

                // Membuat pie chart
                var chart = root.container.children.push(
                    am5percent.PieChart.new(root, {
                        layout: root.horizontalLayout
                    })
                );

                // Membuat series untuk pie chart
                var series = chart.series.push(
                    am5percent.PieSeries.new(root, {
                        name: "Series",
                        valueField: "value",
                        categoryField: "category"
                    })
                );

                // Data untuk pie chart
                series.data.setAll([{
                        category: "Method",
                        value: methodCount
                    },
                    {
                        category: "Result",
                        value: resultCount
                    },
                    {
                        category: "Background",
                        value: backgroundCount
                    }
                ]);
            });

            document.querySelectorAll('.form-delete').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Apakah kamu yakin?',
                        text: "Data jurnal yang dihapus tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
