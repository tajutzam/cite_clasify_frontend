@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h3 class="mb-4 text-white">Hasil Pencarian Scopus</h3>

        <form method="get" action="{{ route('dashboard.scopus.search') }}">
            <div class="input-group mb-4">
                <input type="text" name="keyword" class="form-control" placeholder="Masukkan kata kunci"
                    value="{{ $keyword }}">
                <button class="btn btn-primary" type="submit">Cari</button>
            </div>
        </form>

        @if ($keyword)
            <p class="mb-3 text-white">
                Menampilkan hasil pencarian untuk kata kunci: <strong>{{ $keyword }}</strong>.
                @if($results->total() > 0)
                    Total hasil ditemukan: <strong>{{ $results->total() }}</strong>.
                @else
                    Tidak ada hasil yang ditemukan.
                @endif
            </p>
        @else
            <p class="mb-3 text-muted">Masukkan kata kunci untuk mencari artikel di Scopus.</p>
        @endif

        @if ($results->count())
            <div class="row g-4 mb-4">
                @foreach ($results as $entry)
                    <div class="col-md-6">
                        <div class="card shadow-sm h-100 border-primary">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="bi bi-book me-2 text-primary"></i>
                                    {{ $entry['dc:title'] ?? 'Judul tidak tersedia' }}
                                </h5>
                                <p class="card-text mb-1"><strong>Penulis:</strong>
                                    {{ $entry['dc:creator'] ?? 'Tidak tersedia' }}</p>
                                <p class="card-text mb-1"><strong>Jurnal:</strong>
                                    {{ $entry['prism:publicationName'] ?? '-' }}</p>
                                <p class="card-text mb-1">
                                    <strong>Volume/Issue:</strong>
                                    {{ $entry['prism:volume'] ?? '-' }}/{{ $entry['prism:issueIdentifier'] ?? '-' }}
                                </p>
                                <p class="card-text mb-1"><strong>Tanggal Terbit:</strong>
                                    {{ $entry['prism:coverDisplayDate'] ?? '-' }}</p>

                                @if (!empty($entry['prism:doi']))
                                    <p class="card-text mb-1">
                                        <strong>DOI:</strong>
                                        <a href="https://doi.org/{{ $entry['prism:doi'] }}" target="_blank"
                                            class="text-decoration-none">
                                            {{ $entry['prism:doi'] }}
                                        </a>
                                    </p>
                                @endif

                                <p class="card-text mb-1"><strong>Cited by:</strong> {{ $entry['citedby-count'] ?? 0 }}</p>

                                @if (!empty($entry['affiliation'][0]))
                                    <p class="card-text mb-1">
                                        <strong>Afiliasi:</strong> {{ $entry['affiliation'][0]['affilname'] ?? '-' }},
                                        {{ $entry['affiliation'][0]['affiliation-city'] ?? '-' }},
                                        {{ $entry['affiliation'][0]['affiliation-country'] ?? '-' }}
                                    </p>
                                @endif

                                @php
                                    $scopusLink =
                                        collect($entry['link'] ?? [])->firstWhere('@ref', 'scopus')['@href'] ?? null;
                                @endphp

                                @if ($scopusLink)
                                    <a href="{{ $scopusLink }}" target="_blank"
                                        class="btn btn-sm btn-outline-primary mt-2">
                                        Lihat di Scopus <i class="bi bi-box-arrow-up-right"></i>
                                    </a>
                                @endif
                                <form action="{{ route('dashboard.scopus.library.store') }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    <input type="hidden" name="title" value="{{ $entry['dc:title'] ?? '' }}">
                                    <input type="hidden" name="creator" value="{{ $entry['dc:creator'] ?? '' }}">
                                    <input type="hidden" name="journal"
                                        value="{{ $entry['prism:publicationName'] ?? '' }}">
                                    <input type="hidden" name="volume" value="{{ $entry['prism:volume'] ?? '' }}">
                                    <input type="hidden" name="issue"
                                        value="{{ $entry['prism:issueIdentifier'] ?? '' }}">
                                    <input type="hidden" name="date"
                                        value="{{ $entry['prism:coverDisplayDate'] ?? '' }}">
                                    <input type="hidden" name="doi" value="{{ $entry['prism:doi'] ?? '' }}">
                                    <input type="hidden" name="citedby" value="{{ $entry['citedby-count'] ?? 0 }}">
                                    <input type="hidden" name="affiliation_name"
                                        value="{{ $entry['affiliation'][0]['affilname'] ?? '' }}">
                                    <input type="hidden" name="affiliation_city"
                                        value="{{ $entry['affiliation'][0]['affiliation-city'] ?? '' }}">
                                    <input type="hidden" name="affiliation_country"
                                        value="{{ $entry['affiliation'][0]['affiliation-country'] ?? '' }}">
                                    <input type="hidden" name="scopus_link" value="{{ $scopusLink }}">

                                    <button type="submit" class="btn btn-sm btn-success mt-2">
                                        <i class="bi bi-plus-circle me-1"></i> Tambahkan ke Library
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {{ $results->links('pagination::bootstrap-5') }}
            </div>
        @else
            <p class="text-muted">Tidak ada hasil ditemukan.</p>
        @endif
    </div>
@endsection
