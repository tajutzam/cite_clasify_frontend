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
                    <li class="breadcrumb-item text-white opacity-75">Klasifikasi Text Sitasi</li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <div class="content flex-row-fluid" id="kt_content">
            <div class="row g-5 g-xxl-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h3>Yuk, Klasifikasikan Kalimat Rujukanmu! </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="form_predict" method="post">
                            <div class="mb-3">
                                <label for="" class="">Kalimat Ilmiah</label>
                                <textarea name="text" id="text" class="form-control"></textarea>
                            </div>
                            <button class="btn btn-primary btn-sm" id="">Prediksi</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Histori Prediksi Kalimat</h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="resultTable" class="table table-striped table-bordered text-center align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="min-w-100">No</th>
                                        <th class="min-w-100">User</th>
                                        <th class="min-w-100">Text</th>
                                        <th class="min-w-100">Akurasi</th>
                                        <th class="min-w-100">Hasil Kategori</th>
                                        <th class="min-w-100">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            $(document).ready(function() {
                const table = $('#resultTable').DataTable({
                    processing: true,
                    serverSide: false,
                    ajax: {
                        url: @json(route('result.index')),
                        dataSrc: 'data'
                    },
                    columns: [{
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.row + 1;
                            }
                        },
                        {
                            data: 'user.name'
                        },
                        {
                            data: 'text'
                        },
                        {
                            data: 'accuracy',
                            render: function(data) {
                                return (data * 100).toFixed(2) + '%';
                            }
                        },
                        {
                            data: 'prediction'
                        },
                        {
                            data: null,
                            render: function(data) {
                                return `<button class="btn btn-danger btn-sm btn-delete" data-id="${data.id}">Hapus</button>`;
                            }
                        }
                    ]
                });

                // Hapus data dengan konfirmasi Swal
                $('#resultTable').on('click', '.btn-delete', function() {
                    const id = $(this).data('id');
                    const baseUrl = @json(route('result.delete', ['id' => ':id']));
                    const finalUrl = baseUrl.replace(':id', id);

                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: finalUrl,
                                type: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function() {
                                    Swal.fire(
                                        'Terhapus!',
                                        'Data berhasil dihapus.',
                                        'success'
                                    );
                                    table.ajax.reload(); // reload ulang DataTable
                                },
                                error: function() {
                                    Swal.fire(
                                        'Gagal!',
                                        'Terjadi kesalahan saat menghapus data.',
                                        'error'
                                    );
                                }
                            });
                        }
                    });
                });
            });
        </script>


        <script>
            $('#form_predict').on('submit', function(e) {
                e.preventDefault();

                var backendUrl = @json(env('BACKEND_URL'));

                Swal.fire({
                    title: 'Yakin ingin memproses?',
                    text: "Prediksi akan dilakukan berdasarkan kalimat yang kamu masukkan.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, lanjutkan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: backendUrl + "/predict",
                            method: 'POST',
                            contentType: 'application/json',
                            data: JSON.stringify({
                                "text": $('#text').val()
                            }),
                            success: function(response) {
                                console.log(response);

                                const labels = ["Background", "Method", "Result"];
                                const predictionIndex = response.prediction;
                                const predictionLabel = labels[predictionIndex];
                                const probabilities = response.probability;
                                const maxProbability = Math.max(...probabilities);
                                const probabilityPercent = (maxProbability * 100).toFixed(2);

                                Swal.fire({
                                    title: 'Hasil Prediksi',
                                    html: `
                            <strong>Label:</strong> ${predictionLabel}<br>
                            <strong>Probabilitas:</strong> ${probabilityPercent}%
                        `,
                                    icon: 'success',
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes, Simpan',
                                    cancelButtonText: 'No, Jangan Simpan'
                                }).then((simpan) => {
                                    if (simpan.isConfirmed) {
                                        const url = @json(route('save.result'));

                                        $.ajax({
                                            url: url,
                                            method: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': $(
                                                        'meta[name="csrf-token"]')
                                                    .attr('content')
                                            },
                                            contentType: 'application/json',
                                            data: JSON.stringify({
                                                "text": $('#text').val(),
                                                "prediction": predictionLabel,
                                                "accuracy": maxProbability
                                            }),
                                            success: function(response) {
                                                Swal.fire({
                                                    title: 'History Disimpan',
                                                    text: 'Hasil prediksi disimpan.',
                                                    icon: 'success'
                                                });
                                                $('#resultTable').DataTable()
                                                    .ajax.reload();
                                            },
                                            error: function(xhr) {
                                                Swal.fire({
                                                    title: 'Terjadi Kesalahan',
                                                    text: xhr
                                                        .responseText ||
                                                        'Gagal menyimpan hasil',
                                                    icon: 'error'
                                                });
                                            }
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'History Tidak Disimpan',
                                            text: 'Hasil prediksi tidak disimpan.',
                                            icon: 'info'
                                        });
                                    }
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    title: 'Terjadi Kesalahan',
                                    text: xhr.responseText || 'Gagal melakukan prediksi',
                                    icon: 'error'
                                });
                            }
                        });
                    }
                });

                return false;
            });
        </script>
    @endpush
@endsection
