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
                    <li class="breadcrumb-item text-white opacity-75">Dataset</li>
                </ul>
            </div>
            <div class="d-flex align-items-center py-3 py-md-1">
                <a href="#" class="btn btn-bg-white btn-active-color-primary" data-bs-toggle="modal"
                    data-bs-target="#uji_model" id="kt_toolbar_primary_button">Uji Model</a>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="uji_model">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Pilih Variasi Split Data</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="mb-0">
                        <p>
                            <strong>
                                Jumlah Keseluruhan Data Test : 2021
                            </strong>
                        </p>
                        <label class="form-label">Pilih Persentase Data Test</label>
                        <div id="kt_slider_basic"></div>

                        <div class="pt-5">
                            <div class="fw-semibold mb-2">
                                Data Test: <span id="kt_slider_basic_test">20</span>%
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="uji_model_button">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <div class="content flex-row-fluid" id="kt_content">
            <div class="row g-5 g-xxl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered text-center align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="min-w-50px">No</th>
                                        <th class="min-w-200px">Clean Text Translated</th>
                                        <th class="min-w-100px">Label</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataset['data'] as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-start">{{ $item['processed_text'] ?? '-' }}</td>
                                            <td>
                                                @if ($item['label'] == 0)
                                                    <span class="badge bg-danger">{{ 'background' }}</span>
                                                @elseif ($item['label'] == 1)
                                                    <span class="badge bg-success">{{ 'method' }}</span>
                                                @else
                                                    <span class="badge bg-primary">{{ 'result' ?? 'N/A' }}</span>
                                                @endif
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
                                            <a class="page-link" href="?page={{ $dataset['current_page'] - 1 }}">«</a>
                                        </li>
                                    @endif

                                    {{-- Menampilkan halaman relatif (-3 hingga +3 dari current page) --}}
                                    @php
                                        $start = max(1, $dataset['current_page'] - 3);
                                        $end = min($dataset['last_page'], $dataset['current_page'] + 3);
                                    @endphp

                                    @for ($i = $start; $i <= $end; $i++)
                                        <li class="page-item {{ $i == $dataset['current_page'] ? 'active' : '' }}">
                                            <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    {{-- Tombol "Next" --}}
                                    @if ($dataset['current_page'] < $dataset['last_page'])
                                        <li class="page-item">
                                            <a class="page-link" href="?page={{ $dataset['current_page'] + 1 }}">»</a>
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
    @push('js')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var slider = document.querySelector("#kt_slider_basic");
                var valueTest = document.querySelector("#kt_slider_basic_test");
                noUiSlider.create(slider, {
                    start: [100],
                    connect: [true, false],
                    range: {
                        min: 10,
                        max: 100
                    },
                    step: 5
                });

                slider.noUiSlider.on("update", function(values) {
                    valueTest.innerHTML = values;
                });
            });

            $(document).ready(function() {
                $('#uji_model_button').on('click', function() {
                    var valueTest = document.querySelector("#kt_slider_basic_test").textContent;

                    var backendUrl = @json(env('BACKEND_URL'));
                    const data = {
                        test_size: (valueTest / 100)
                    }

                    Swal.fire({
                        title: 'Loading...',
                        text: 'Please wait while we process your request.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    $.ajax({
                        url: backendUrl + "/test",
                        type: 'post',
                        dataType: 'json',
                        headers: {
                            'Content-type': 'application/json'
                        },
                        data: JSON.stringify(data),
                        success: function(response) {
                            Swal.close();
                            console.log(response);

                            var accuracy = response.accuracy *
                                100;
                            var classificationReport = response.classification_report;
                            var confusionMatrix = response.confusion_matrix;

                            var resultHtml = `
                                <h3>Test Results</h3>
                                <p><strong>Accuracy:</strong> ${accuracy.toFixed(2)}%</p>
                                <h4>Classification Report</h4>
                                <ul>
                                    <li><strong>Background:</strong> F1-Score: ${classificationReport["0"]["f1-score"].toFixed(2)}, Precision: ${classificationReport["0"]["precision"].toFixed(2)}, Recall: ${classificationReport["0"]["recall"].toFixed(2)}</li>
                                    <li><strong>Method:</strong> F1-Score: ${classificationReport["1"]["f1-score"].toFixed(2)}, Precision: ${classificationReport["1"]["precision"].toFixed(2)}, Recall: ${classificationReport["1"]["recall"].toFixed(2)}</li>
                                    <li><strong>Result:</strong> F1-Score: ${classificationReport["2"]["f1-score"].toFixed(2)}, Precision: ${classificationReport["2"]["precision"].toFixed(2)}, Recall: ${classificationReport["2"]["recall"].toFixed(2)}</li>
                                </ul>
                            `;
                            Swal.fire({
                                title: `Test Completed with  ${response.total_data} data test`,
                                html: resultHtml,
                                confirmButtonText: 'Ok',
                                cancelButtonText: 'Close',
                                focusCancel: true
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "/dashboard/uji_model";
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.close();
                            $('#result').html('Error: ' + error);
                        }
                    });
                });
            });
        </script>
    @endpush

@endsection
