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
                    <li class="breadcrumb-item text-white opacity-75">Referensi Yang Disimpan</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <div class="content flex-row-fluid" id="kt_content">
            <div class="row g-5 g-xxl-8">
                @forelse ($librarys as $library)
                    <div class="col-md-6 col-xl-4">
                        <div class="card shadow-sm mb-5 border border-gray-200 position-relative">
                            <form action="{{ route('dashboard.library.destroy', $library->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus referensi ini?')"
                                class="position-absolute top-0 end-0 m-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-icon btn-danger" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>

                            <div class="card-body">
                                <h5 class="card-title fw-bold text-dark mb-3">
                                    <i class="fas fa-book-open me-2 text-primary"></i>{{ $library->title }}
                                </h5>

                                <div class="mb-2"><i class="fas fa-user me-2 text-muted"></i><strong>Author:</strong>
                                    {{ $library->creator }}</div>
                                <div class="mb-2">
                                    <span class="badge bg-primary">Journal: {{ $library->journal }}</span>
                                    <span class="badge bg-secondary">Vol. {{ $library->volume }}, No.
                                        {{ $library->issue }}</span>
                                </div>
                                <div class="mb-2"><i
                                        class="fas fa-calendar-alt me-2 text-muted"></i><strong>Date:</strong>
                                    {{ $library->date }}</div>
                                <div class="mb-2">
                                    <i class="fas fa-university me-2 text-muted"></i>
                                    <strong>Affiliation:</strong>
                                    {{ $library->affiliation_name }}, {{ $library->affiliation_city }},
                                    {{ $library->affiliation_country }}
                                </div>

                                <div class="mb-2">
                                    <i class="fas fa-link me-2 text-muted"></i>
                                    <strong>DOI:</strong>
                                    <a href="https://doi.org/{{ $library->doi }}" target="_blank" class="text-primary">
                                        {{ $library->doi }}
                                    </a>
                                </div>

                                <div class="mb-4">
                                    <i class="fas fa-external-link-alt me-2 text-muted"></i>
                                    <a href="{{ $library->scopus_link }}" target="_blank" class="text-info">
                                        Lihat di Scopus
                                    </a>
                                </div>

                                <div class="text-muted small">Disimpan pada:
                                    {{ \Carbon\Carbon::parse($library->created_at)->format('d M Y') }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">Belum ada referensi yang disimpan.</div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $librarys->links() }}
            </div>
        </div>
    </div>
@endsection
