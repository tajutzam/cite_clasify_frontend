@extends('layouts.dashboard')
@section('content')
    <div class="toolbar py-5 py-lg-15" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <div class="page-title d-flex flex-column me-3">
                <!--begin::Title-->
                <h1 class="d-flex text-white fw-bolder my-1 fs-3">History Uji Model</h1>
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
                    <li class="breadcrumb-item text-white opacity-75">History Uji Model</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl mt-5">
                <div class="content flex-row-fluid" id="kt_content">
                    <div class="row g-5 g-xxl-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered text-center align-middle">
                                        <thead class="table-dark">
                                            <tr>
                                                <th class="min-w-50px">No</th>
                                                <th class="min-w-20px">Accuracy</th>
                                                <th>Confusion Matrix Image</th>
                                                <th class="min-w-100px">Test Size</th>
                                                <th class="min-w-100px">Total Data Test</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($clasifications as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->accuracy }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <img src="{{ asset($item->confusion_matrix) }}"
                                                                alt="confusion-matrix" class="img-fluid rounded shadow-sm"
                                                                style="max-height: 200px; width: auto;">
                                                        </div>
                                                    </td>
                                                    <td>{{ $item->test_size }} / 1</td>
                                                    <td>{{ $item->total_data }}</td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <button type="button" class="btn btn-sm btn-primary"
                                                                data-bs-toggle="modal" data-bs-target="#detail_model"
                                                                data-item='@json($item)'>
                                                                Detail
                                                            </button>
                                                            <button class="btn btn-sm btn-danger">Delete</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @if (isset($dataset['last_page']) && $dataset['last_page'] > 1)
                                <div class="d-flex justify-content-end mt-4 mb-4">
                                    <nav>
                                        <ul class="pagination">
                                            {{-- Tombol "Previous" --}}
                                            @if ($dataset['current_page'] > 1)
                                                <li class="page-item">
                                                    <a class="page-link"
                                                        href="?page={{ $dataset['current_page'] - 1 }}">«</a>
                                                </li>
                                            @endif

                                            {{-- Menampilkan halaman relatif (-3 hingga +3 dari current page) --}}
                                            @php
                                                $start = max(1, $dataset['current_page'] - 3);
                                                $end = min($dataset['last_page'], $dataset['current_page'] + 3);
                                            @endphp

                                            @for ($i = $start; $i <= $end; $i++)
                                                <li class="page-item {{ $i == $dataset['current_page'] ? 'active' : '' }}">
                                                    <a class="page-link"
                                                        href="?page={{ $i }}">{{ $i }}</a>
                                                </li>
                                            @endfor

                                            {{-- Tombol "Next" --}}
                                            @if ($dataset['current_page'] < $dataset['last_page'])
                                                <li class="page-item">
                                                    <a class="page-link"
                                                        href="?page={{ $dataset['current_page'] + 1 }}">»</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </nav>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="detail_model">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Detail Uji Model</h3>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div class="modal-body">
                    <div id="modal-content-detail">
                        <div class="text-center text-muted">Loading...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            const modal = document.getElementById('detail_model');
            modal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const data = JSON.parse(button.getAttribute('data-item'));

                let reportHtml = '';
                const report = data.classification_report;

                // Mapping label angka ke teks
                const labelNames = {
                    0: "Background",
                    1: "Method",
                    2: "Result"
                };

                if (report && typeof report === 'object') {
                    let rows = '';

                    for (const [key, val] of Object.entries(report)) {
                        // Cek apakah key numerik (label) atau bukan
                        if (!isNaN(key)) {
                            const labelText = labelNames[key] ?? `Label ${key}`;

                            rows += `
                            <tr>
                                <td>${labelText}</td>
                                <td>${val.precision?.toFixed(3) ?? '-'}</td>
                                <td>${val.recall?.toFixed(3) ?? '-'}</td>
                                <td>${val["f1-score"]?.toFixed(3) ?? '-'}</td>
                                <td>${val.support ?? '-'}</td>
                            </tr>`;
                        }
                    }

                    // Tambahkan macro avg dan weighted avg jika ada
                    if (report["macro avg"]) {
                        const macro = report["macro avg"];
                        rows += `
                        <tr class="table-info">
                            <td><strong>Macro Avg</strong></td>
                            <td>${macro.precision?.toFixed(3) ?? '-'}</td>
                            <td>${macro.recall?.toFixed(3) ?? '-'}</td>
                            <td>${macro["f1-score"]?.toFixed(3) ?? '-'}</td>
                            <td>${macro.support ?? '-'}</td>
                        </tr>`;
                    }

                    if (report["weighted avg"]) {
                        const weighted = report["weighted avg"];
                        rows += `
                        <tr class="table-warning">
                            <td><strong>Weighted Avg</strong></td>
                            <td>${weighted.precision?.toFixed(3) ?? '-'}</td>
                            <td>${weighted.recall?.toFixed(3) ?? '-'}</td>
                            <td>${weighted["f1-score"]?.toFixed(3) ?? '-'}</td>
                            <td>${weighted.support ?? '-'}</td>
                        </tr>`;
                    }

                    reportHtml = `
                    <h5 class="mt-4">Classification Report</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm text-center align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th>Label</th>
                                    <th>Precision</th>
                                    <th>Recall</th>
                                    <th>F1 Score</th>
                                    <th>Support</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${rows}
                            </tbody>
                        </table>
                    </div>`;
                }

                document.getElementById('modal-content-detail').innerHTML = `
                <p><strong>Accuracy:</strong> ${parseFloat(data.accuracy).toFixed(4)}</p>
                <p><strong>Test Size:</strong> ${data.test_size}</p>
                <p><strong>Total Data:</strong> ${data.total_data}</p>
                <p><strong>Created At:</strong> ${data.created_at}</p>
                <div class="my-3 text-center">
                    <img src="${data.confusion_matrix}" alt="confusion-matrix"
                        class="img-fluid rounded shadow-sm" style="max-height: 300px;">
                </div>
                ${reportHtml}
            `;
            });
        </script>
    @endpush


@endsection
